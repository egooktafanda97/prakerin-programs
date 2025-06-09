<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookPrakerin extends Model
{
    use HasFactory;

    protected $table = 'logbook_prakerin';
    protected $fillable = [
        'user_id',
        'instruktur_id',
        'penempatan_id',
        'tanggal',
        'aktivitas',
        'validasi_instruktur',
        'validasi_instruktur_at'
    ];

    public function penempatanPrakerin()
    {
        return $this->belongsTo(PenempatanPrakerin::class);
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_id');
    }
}
