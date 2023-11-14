<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'nama', 'nim', 'prodi', 'tanggal',
        // Tambahkan atribut-atribut lain yang Anda miliki
    ];
}
