<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pembelian;
use App\Models\Penjualan;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi data masukan
        $request->validate([
            'nama_produk' => 'required|unique:products,nama_produk', // Memastikan nama produk unik
            'jumlah_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'kadaluarsa' => 'nullable|date',
        ], [
            'nama_produk.unique' => 'Product name already exists.', // Pesan error untuk duplikasi nama produk
        ]);

        // Jika validasi berhasil, simpan produk
        Product::create($request->all());

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product added successfully.');


    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }



    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Temukan semua pembelian yang terkait dengan produk yang akan dihapus
        $pembelians = Pembelian::where('product_id', $product->id)->get();

        // Temukan semua penjualan yang terkait dengan produk yang akan dihapus
        $penjualans = Penjualan::where('product_id', $product->id)->get();

        // Atur product_id pada setiap pembelian menjadi null
        foreach ($pembelians as $pembelian) {
            $pembelian->product_id = null;
            $pembelian->save();
        }

        // Atur product_id pada setiap penjualan menjadi null
        foreach ($penjualans as $penjualan) {
            $penjualan->product_id = null;
            $penjualan->save();
        }

        // Hapus produk setelah menghapus referensi produk pada semua pembelian dan penjualan
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product added successfully.');

    }
    public function checkProduct(Request $request)
    {
        $nama_produk = $request->nama_produk;

        $product = Product::where('nama_produk', $nama_produk)->first();

        if ($product) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
        return redirect()->route('products.index')->with('success', 'Product added successfully.');

    }
}
