<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;
    protected $table = 'instruktur';

    protected $fillable = [
        'user_id',
        'nama',
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
        return $this->hasMany(PenempatanPrakerin::class);
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
