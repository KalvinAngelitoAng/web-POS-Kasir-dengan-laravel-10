<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaksi';

    protected $fillable = [
        'no_transaksi',
        'tgl_transaksi',
        'subtotal',
        'diskon',
        'kembalian',
        'uang_pembeli',
        'total_bayar',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
