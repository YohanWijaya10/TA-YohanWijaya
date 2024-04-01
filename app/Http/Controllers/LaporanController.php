<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil tanggal hari ini
        $today = Carbon::today()->toDateString();

        // Menetapkan tanggal awal dan tanggal akhir ke tanggal hari ini secara default
        $startDate = $request->input('start_date', $today);
        $endDate = $request->input('end_date', $today);

        // Mengambil data penjualan dalam rentang tanggal yang ditentukan
        $laporanPenjualan = Penjualan::whereBetween('tanggal', [$startDate, $endDate])->get();

        // Menghitung total pendapatan dari setiap penjualan
        $totalPendapatan = $laporanPenjualan->sum(function ($penjualan) {
            // Periksa apakah 'product' tidak null sebelum mengakses properti 'harga_jual'
            if (!is_null($penjualan->product) && !is_null($penjualan->product->harga_jual)) {
                return $penjualan->jumlah_barang * $penjualan->product->harga_jual;
            } else {
                return 0; // Atau nilai default lainnya jika properti 'harga_jual' tidak tersedia
            }
        });

        // Menghitung total biaya pembelian
        $totalBiayaPembelian = $laporanPenjualan->sum(function ($penjualan) {
            // Periksa apakah 'product' tidak null sebelum mengakses properti 'harga_beli'
            if (!is_null($penjualan->product) && !is_null($penjualan->product->harga_beli)) {
                return $penjualan->jumlah_barang * $penjualan->product->harga_beli;
            } else {
                return 0; // Atau nilai default lainnya jika properti 'harga_beli' tidak tersedia
            }
        });

        // Hitung pendapatan bersih
        $pendapatanBersih = $totalPendapatan - $totalBiayaPembelian;

        return view('laporan', compact('laporanPenjualan', 'startDate', 'endDate', 'totalPendapatan', 'pendapatanBersih'));
    }
}
