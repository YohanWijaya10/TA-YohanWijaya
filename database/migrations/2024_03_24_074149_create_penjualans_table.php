<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->foreignId('product_id')->constrained();
            $table->date('tanggal');
            $table->integer('jumlah_barang');
            $table->integer('total_pembelian');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
};
