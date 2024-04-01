<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Pembelian;


class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        // Temukan pembelian yang terkait dengan vendor yang akan dihapus
        $pembelians = Pembelian::where('vendor_id', $vendor->id)->get();

        // Ubah vendor pada setiap pembelian
        foreach ($pembelians as $pembelian) {
            // Atau set ke nilai yang sesuai dengan teks yang Anda inginkan
            $pembelian->vendor_id = null; // Jika ingin set menjadi null
            // $pembelian->vendor_id = 0; // Jika ingin set menjadi 0
            $pembelian->save();
        }

        $vendor->delete();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor deleted successfully.');
    }
}
