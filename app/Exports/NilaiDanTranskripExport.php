<?php

namespace App\Exports;

use App\Models\NilaiDanTranskrip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiDanTranskripExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil semua data yang ingin di-export
        return NilaiDanTranskrip::select('mahasiswa_id', 'matakuliah_id', 'nilai_angka', 'sks', 'sksn')->get();
    }

    public function headings(): array
    {
        return [
            'Mahasiswa ID',
            'Mata Kuliah ID',
            'Nilai Angka',
            'SKS',
            'SKSN',
        ];
    }
}
