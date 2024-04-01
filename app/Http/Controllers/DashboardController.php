<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pembelian;
use App\Models\Penjualan; // Import model Penjualan
use Carbon\Carbon; // Import Carbon
use Illuminate\Support\Facades\DB; // Import DB facade


class DashboardController extends Controller
{
    

    public function index()
    {
        // Total Pendapatan Hari Ini
        $todayIncome = Penjualan::whereDate('tanggal', Carbon::today())->sum('total_pembelian');
    
        // Total Pendapatan Kemarin
        $yesterdayIncome = Penjualan::whereDate('tanggal', Carbon::yesterday())->sum('total_pembelian');
    
        // Total Pendapatan Bulan Ini
        $monthlyIncome = Penjualan::whereMonth('tanggal', Carbon::now()->month)->sum('total_pembelian');
    
        // Weekly Pendapatan
        $startDateOfWeek = Carbon::now()->startOfWeek(); // Get the start date of the current week
        $endDateOfWeek = Carbon::now()->endOfWeek(); // Get the end date of the current week
        $weeklyIncome = Penjualan::whereBetween('tanggal', [$startDateOfWeek, $endDateOfWeek])->sum('total_pembelian');
    
        // 3 Barang yang Paling Laku Bulan Ini
        $bestSellingProducts = Penjualan::select('product_id')
            ->selectRaw('SUM(jumlah_barang) as total_barang')
            ->whereMonth('tanggal', Carbon::now()->month)
            ->groupBy('product_id')
            ->orderByDesc('total_barang')
            ->take(3)
            ->get();
    
        $bestSellingProductsData = [];
        foreach ($bestSellingProducts as $item) {
            $product = Product::find($item->product_id);
            $bestSellingProductsData[] = [
                'product' => $product,
                'total_barang' => $item->total_barang,
            ];
        }
        $expiredProducts = Product::where('kadaluarsa', '<', Carbon::today())->paginate(5);
        $productsToRestock = Product::where('jumlah_barang', '<', 3)->paginate(5);
    
        return view('dashboard', [
            'todayIncome' => $todayIncome,
            'yesterdayIncome' => $yesterdayIncome,
            'weeklyIncome' => $weeklyIncome,
            'monthlyIncome' => $monthlyIncome,
            'bestSellingProductsData' => $bestSellingProductsData,
            'expiredProducts' => $expiredProducts, 
            'productsToRestock' => $productsToRestock,
        ]);
    }

}
