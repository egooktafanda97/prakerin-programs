<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPenempatan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_penempatans';

    protected $fillable = [
        'tahun_ajaran',
        'siswa_id',
        'perusahaan_id',
        'guru_id',
        'instruktur_id',
        'status',
        'alasan',
        'tanggal_pengajuan',
        'tanggal_diterima',
        'tanggal_ditolak',
        'file_pendukung',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_diterima' => 'datetime',
        'tanggal_ditolak' => 'datetime',
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
}
