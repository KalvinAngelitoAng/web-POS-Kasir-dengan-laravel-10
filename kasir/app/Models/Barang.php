<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'tbl_barang';

    protected $fillable = [
        'id_jenis',
        'nama_barang',
        'harga',
        'stok',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
