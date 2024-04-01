<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Product;
use App\Models\Vendor;

class PembelianController extends Controller
{


    public function index()
    {
        $pembelians = Pembelian::with('product', 'vendor')->get();
        return view('pembelians.index', compact('pembelians'));
    }

    public function create()
    {
        $products = Product::all();
        $vendors = Vendor::all();
        return view('pembelians.create', compact('products', 'vendors'));
    }

    public function store(Request $request)
    {
        // Ambil data dari formulir
        $input = $request->all();

        // Konversi harga menjadi tipe data numerik
        $harga = (float) str_replace('Rp ', '', $input['harga']); // Hapus 'Rp ' dan konversi ke float

        // Konversi jumlah barang menjadi tipe data numerik
        $jumlahBarang = (int) $input['jumlah_barang'];

        // Hitung total harga berdasarkan harga produk dan jumlah barang
        $total = $harga * $jumlahBarang;

        // Tambahkan total ke data pembelian
        $input['total'] = $total;

        // Buat pembelian baru
        $pembelian = Pembelian::create($input);

      

        // Update jumlah barang pada produk terkait
        $product = Product::findOrFail($input['product_id']);
        $product->jumlah_barang += $jumlahBarang; // Menambahkan jumlah barang yang dibeli
        $product->save();

        return redirect()->route('pembelians.index')->with('success', 'Pembelian created successfully.');
    }



    public function edit(Pembelian $pembelian)
    {
        $products = Product::all();
        $vendors = Vendor::all();
        return view('pembelians.edit', compact('pembelian', 'products', 'vendors'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $pembelian->update($request->all());
        return redirect()->route('pembelians.index')->with('success', 'Pembelian updated successfully.');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();
        return redirect()->route('pembelians.index')->with('success', 'Pembelian deleted successfully.');
    }

    

    
}
