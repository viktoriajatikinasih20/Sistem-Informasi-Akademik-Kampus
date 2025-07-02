<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\NilaiDanTranskrip;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahMataKuliah = MataKuliah::count();

        // Hitung IPK tiap mahasiswa
        $nilaiAll = NilaiDanTranskrip::with('matakuliah')->get()->groupBy('mahasiswa_id');

        $ipkList = [];

        foreach ($nilaiAll as $mahasiswaId => $nilaiMahasiswa) {
            $totalSks = 0;
            $totalSksn = 0;

            foreach ($nilaiMahasiswa as $nilai) {
                $bobot = $this->bobotNilai($nilai->nilai_angka);
                $sks = $nilai->matakuliah->sks;
                $totalSks += $sks;
                $totalSksn += $bobot * $sks;
            }

            $ipk = $totalSks > 0 ? round($totalSksn / $totalSks, 2) : 0;
            $ipkList[] = $ipk;
        }

        $rataRataIPK = count($ipkList) > 0 ? round(array_sum($ipkList) / count($ipkList), 2) : 0;

        $mahasiswaTerbaru = Mahasiswa::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'jumlahMahasiswa',
            'jumlahMataKuliah',
            'rataRataIPK',
            'mahasiswaTerbaru'
        ));
    }

    // Fungsi bobot nilai (sama seperti di controller NilaiDanTranskrip)
    private function bobotNilai($nilai)
    {
        if ($nilai >= 85) return 4.00;
        if ($nilai >= 70) return 3.00;
        if ($nilai >= 55) return 2.00;
        if ($nilai >= 40) return 1.00;
        return 0.00;
    }
}
