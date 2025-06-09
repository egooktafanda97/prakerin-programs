<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
        'user_id',
        'nip',
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
}
