<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenempatanPrakerin extends Model
{
    use HasFactory;
    protected $table = 'penempatan_prakerin';

    protected $fillable = [
        'tahun_ajaran',
        'siswa_id',
        'perusahaan_id',
        'guru_id',
        'instruktur_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }

    // Relasi ke logbook prakerin
    public function logbookPrakerin()
    {
        return $this->hasMany(LogbookPrakerin::class);
    }

    // Relasi ke penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
