<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiDanTranskrip extends Model
{
    protected $table = 'nilai_dan_transkrip';

    protected $fillable = [
        'mahasiswa_id',
        'matakuliah_id',
        'nilai_angka', // harus angka asli, misal 90
        'sks',
        'sksn',       // bisa otomatis diisi dari perhitungan
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    // Accessor nilai huruf berdasarkan nilai angka
    public function getNilaiHurufAttribute()
    {
        $nilai = $this->nilai_angka;

        return match (true) {
            $nilai >= 85 => 'A',
            $nilai >= 70 => 'B',
            $nilai >= 60 => 'C',
            $nilai >= 50 => 'D',
            default => 'E',
        };
    }

    // Ambil bobot huruf dari nilai huruf
    public function getBobotHurufAttribute()
    {
        return match ($this->nilai_huruf) {
            'A' => 4.00,
            'B' => 3.00,
            'C' => 2.00,
            'D' => 1.00,
            default => 0.00,
        };
    }

    // Hitung SKSN = bobot huruf x SKS
    public function getSksnAttribute()
    {
        return $this->bobot_huruf * $this->sks;
    }
}
