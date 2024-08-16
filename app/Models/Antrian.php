<?php

namespace App\Models;

use App\Models\Loket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Antrian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['loket_id', 'no_antrian', 'status'];

    // Jika Anda menggunakan casting, pastikan ini diatur dengan benar
    protected $casts = [
        'loket_id' => 'integer',
    ];
    public function loket()
    {
        return $this->belongsTo(Loket::class);
    }
}
