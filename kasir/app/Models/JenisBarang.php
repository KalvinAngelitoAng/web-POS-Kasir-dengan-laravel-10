<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenis_barang';

    protected $fillable = [
        'nama_jenis',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
