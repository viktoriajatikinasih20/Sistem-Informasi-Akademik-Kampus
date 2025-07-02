<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiDanTranskrip;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\NilaiDanTranskripExport;

class NilaiDanTranskripController extends Controller
{
    public function index()
    {
        $data = NilaiDanTranskrip::with(['mahasiswa', 'matakuliah'])->get();

        return view('nilaidantranskrip.index', compact('data'));
    }

    public function perMahasiswa()
    {
        $data = NilaiDanTranskrip::with(['mahasiswa', 'matakuliah'])->get();

        // Hitung ringkasan total untuk semua data
        $jumlahMatkul = $data->groupBy('matakuliah_id')->count();
        $totalSks = $data->sum(fn($item) => $item->matakuliah->sks);
        $totalSksn = $data->sum(fn($item) => $item->bobot * $item->matakuliah->sks);
        $ipk = $totalSks > 0 ? $totalSksn / $totalSks : 0;

        // Hitung IPK per mahasiswa
        $nilaiPerMhs = $data->groupBy('mahasiswa_id');

        $ipkPerMahasiswa = [];
        foreach ($nilaiPerMhs as $mahasiswaId => $nilaiMahasiswa) {
            $totalSksMhs = $nilaiMahasiswa->sum(fn($item) => $item->matakuliah->sks);
            $totalSksnMhs = $nilaiMahasiswa->sum(fn($item) => $item->bobot * $item->matakuliah->sks);
            $ipkMhs = $totalSksMhs > 0 ? $totalSksnMhs / $totalSksMhs : 0;

            $ipkPerMahasiswa[] = [
                'mahasiswa' => $nilaiMahasiswa->first()->mahasiswa,
                'total_sks' => $totalSksMhs,
                'ipk' => $ipkMhs,
            ];
        }

        // Hitung rata-rata IPK semua mahasiswa
        $rataRataIpk = count($ipkPerMahasiswa) > 0 ? array_sum(array_column($ipkPerMahasiswa, 'ipk')) / count($ipkPerMahasiswa) : 0;

        return view('nilaidantranskrip.permahasiswa', compact(
            'data',
            'jumlahMatkul',
            'totalSks',
            'totalSksn',
            'ipk',
            'ipkPerMahasiswa',
            'rataRataIpk'
        ));
    }


    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $matakuliah = MataKuliah::all();
        return view('nilaidantranskrip.create', compact('mahasiswa', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'matakuliah_id' => 'required|exists:mata_kuliah,id',
            'nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        $matakuliah = MataKuliah::findOrFail($request->matakuliah_id);
        $bobot = $this->bobotNilai($request->nilai_angka);
        $sksn = $bobot * $matakuliah->sks;

        NilaiDanTranskrip::create([
            'mahasiswa_id'   => $request->mahasiswa_id,
            'matakuliah_id'  => $request->matakuliah_id,
            'nilai_angka'    => $request->nilai_angka,
            'sks'            => $matakuliah->sks,
            'sksn'           => $sksn,
        ]);

        return redirect()->route('nilaidantranskrip.index')->with('success', 'Nilai dan Transkrip berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nilaidantranskrip = NilaiDanTranskrip::findOrFail($id);
        $mahasiswa = Mahasiswa::all();
        $matakuliah = MataKuliah::all();
        return view('nilaidantranskrip.edit', compact('nilaidantranskrip', 'mahasiswa', 'matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id'   => 'required|exists:mahasiswa,id',
            'matakuliah_id'  => 'required|exists:mata_kuliah,id',
            'nilai_angka'    => 'required|numeric|min:0|max:100',
        ]);

        $nilaidantranskrip = NilaiDanTranskrip::findOrFail($id);
        $matakuliah = MataKuliah::findOrFail($request->matakuliah_id);
        $bobot = $this->bobotNilai($request->nilai_angka);
        $sksn = $bobot * $matakuliah->sks;

        $nilaidantranskrip->update([
            'mahasiswa_id'   => $request->mahasiswa_id,
            'matakuliah_id'  => $request->matakuliah_id,
            'nilai_angka'    => $request->nilai_angka,
            'sks'            => $matakuliah->sks,
            'sksn'           => $sksn,
        ]);

        return redirect()->route('nilaidantranskrip.index')->with('success', 'Nilai dan Transkrip berhasil diperbarui.');
    }

    public function destroy($id)
    {
        NilaiDanTranskrip::destroy($id);
        return redirect()->route('nilaidantranskrip.index')->with('success', 'Nilai dan Transkrip berhasil dihapus.');
    }

    // Konversi nilai angka ke huruf
    private function konversiHuruf($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 40) return 'D';
        return 'E';
    }

    // Konversi nilai angka ke bobot
    private function bobotNilai($nilai)
    {
        if ($nilai >= 85) return 4.00;
        if ($nilai >= 70) return 3.00;
        if ($nilai >= 55) return 2.00;
        if ($nilai >= 40) return 1.00;
        return 0.00;
    }

    public function exportPdf($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $nilaiData = NilaiDanTranskrip::where('mahasiswa_id', $id)->with('matakuliah')->get();
    
        $totalSks = 0;
        $totalSksn = 0;
    
        foreach ($nilaiData as $item) {
            switch ($item->nilai_huruf) {
                case 'A': $bobot = 4.00; break;
                case 'B': $bobot = 3.00; break;
                case 'C': $bobot = 2.00; break;
                case 'D': $bobot = 1.00; break;
                default: $bobot = 0.00;
            }
    
            $sks = $item->matakuliah->sks;
            $sksn = $sks * $bobot;
    
            $totalSks += $sks;
            $totalSksn += $sksn;
        }
    
        $ipk = $totalSks > 0 ? round($totalSksn / $totalSks, 2) : 0.00;
    
        $pdf = Pdf::loadView('nilaidantranskrip.exportpdf', compact('mahasiswa', 'nilaiData', 'totalSks', 'totalSksn', 'ipk'))
                  ->setPaper('A4', 'portrait');
    
        return $pdf->stream('Transkrip_' . $mahasiswa->nama . '.pdf');
    }
        

    public function show($id)
    {
        // Misal: tampilkan detail nilai per mahasiswa
        $nilai = NilaiDanTranskrip::with(['mahasiswa', 'matakuliah'])->findOrFail($id);
        return view('nilaidantranskrip.show', compact('nilai'));
    }
}
