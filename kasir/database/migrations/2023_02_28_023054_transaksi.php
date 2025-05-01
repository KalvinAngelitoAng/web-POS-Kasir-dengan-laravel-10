<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->date('tgl_transaksi')->nullable();
            $table->integer('diskon')->nullable();
            $table->bigInteger('total_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaksi');
    }
};
