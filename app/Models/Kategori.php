<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    // Kolom yang akan dianggap sebagai primary key
    protected $primaryKey = 'id';

    // Gunakan incrementing false karena id akan otomatis bertambah
    public $incrementing = true;
}
