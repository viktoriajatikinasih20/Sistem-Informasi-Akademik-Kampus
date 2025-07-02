<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = ['nama', 'nim', 'fakultas', 'prodi', 'tempat_lahir', 'tanggal_lahir'];

    /**
     * Relasi: satu mahasiswa memiliki banyak nilai/transkrip
     */
    public function transkrip()
    {
        return $this->hasMany(NilaiDanTranskrip::class);
    }
}
