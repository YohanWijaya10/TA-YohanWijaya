<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['product_id', 'tanggal', 'jumlah_barang', 'total_pembelian'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($penjualan) {
            // Mendapatkan pembelian terakhir
            $lastPembelian = Penjualan::orderBy('id', 'desc')->first();

            // Menentukan tanggal saat ini
            $currentDate = now()->format('Y-m-d');

            // Menentukan nomor urut berikutnya
            if ($lastPembelian && $lastPembelian->created_at->format('Y-m-d') === $currentDate) {
                // Jika pembelian terakhir memiliki tanggal yang sama dengan tanggal saat ini
                // Maka nomor urut berikutnya adalah nomor urut pembelian terakhir + 1
                $nextNumber = ((int) substr($lastPembelian->sku, -3)) + 1;
            } else {
                // Jika tanggal pembelian terakhir berbeda dengan tanggal saat ini
                // Maka nomor urut direset menjadi 1
                $nextNumber = 1;
            }

            // Format tanggal, bulan, dan tahun
            $tanggal = now()->format('d');
            $bulan = now()->format('m');
            $tahun = now()->format('y');

            // Mengatur format SKU dengan PB + tanggal + bulan + tahun + nomor urut
            $penjualan->sku = 'PJ' . $tanggal . $bulan . $tahun  . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
