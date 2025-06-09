<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';

    protected $fillable = [
        'siswa_id',
        'penempatan_id',
        'nilai_kehadiran',
        'nilai_disiplin',
        'nilai_kerjasama',
        'nilai_inisiatif',
        'nilai_akhir',
        'catatan',
        'instruktur_id'
    ];

    public function penempatanPrakerin()
    {
        return $this->belongsTo(PenempatanPrakerin::class);
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }
}
