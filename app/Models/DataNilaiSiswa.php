<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataNilaiSiswa extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak mengikuti konvensi jamak Laravel)
    protected $table = 'data_nilai_siswa';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_dokumen',
        'dokument',
        'keterangan',
    ];
}
