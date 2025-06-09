<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'role'
    ];

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    // Relasi ke model Guru
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    // Relasi ke model Perusahaan
    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class);
    }

    // Relasi ke model Instruktur
    public function instruktur()
    {
        return $this->hasOne(Instruktur::class);
    }
}
