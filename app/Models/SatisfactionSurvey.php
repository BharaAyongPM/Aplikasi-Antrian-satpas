<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatisfactionSurvey extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan default
    protected $table = 'surveys';

    // Tentukan field yang bisa diisi
    protected $fillable = ['response'];

    // Jika menggunakan timestamp (created_at dan updated_at)
    public $timestamps = true;
}
