<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_transaksi';

    protected $fillable = [
        'no_transaksi',
        'id_barang',
        'qty',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
