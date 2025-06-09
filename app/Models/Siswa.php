<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'nama',
        'kelas',
        'jurusan',
        'no_hp',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke penempatan prakerin
    public function penempatanPrakerin()
    {
        return $this->hasOne(PenempatanPrakerin::class);
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class, 'siswa_id', 'id');
    }
}
