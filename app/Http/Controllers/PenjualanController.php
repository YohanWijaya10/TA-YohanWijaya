<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Product;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('product')->get();
        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $products = Product::all();
        return view('penjualans.create', compact('products'));
    }

    public function store(Request $request)
{
    $product = Product::find($request->product_id);

    // Validasi apakah stok cukup
    if ($product->jumlah_barang >= $request->jumlah_barang) {
        $total = $product->harga_jual * $request->jumlah_barang;

        // Kurangi jumlah_barang dari stok produk
        $product->jumlah_barang -= $request->jumlah_barang;
        $product->save();

        Penjualan::create([
            'product_id' => $request->product_id,
            'tanggal' => $request->tanggal,
            'jumlah_barang' => $request->jumlah_barang,
            'total_pembelian' => $total,
        ]);

        return redirect()->route('penjualans.index')->with('success', 'Penjualan created successfully.');
    } else {
        return redirect()->back()->with('error', 'Insufficient stock.');
    }
}



    public function edit(Penjualan $penjualan)
    {
        $products = Product::all();
        return view('penjualans.edit', compact('penjualan', 'products'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $penjualan->update($request->all());
        return redirect()->route('penjualans.index')->with('success', 'Penjualan updated successfully.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualans.index')->with('success', 'Penjualan deleted successfully.');
    }
}
