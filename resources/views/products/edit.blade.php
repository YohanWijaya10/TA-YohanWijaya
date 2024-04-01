@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Edit Product</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_produk">Product Name:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $product->nama_produk }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Quantity:</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="{{ $product->jumlah_barang }}" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Buying Price:</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ $product->harga_beli }}" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Selling Price:</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $product->harga_jual }}" required>
            </div>
            <div class="form-group">
                <label for="kadaluarsa">Tanggal Kadaluarsa:</label>
                <input type="date" class="form-control" id="kadaluarsa" name="kadaluarsa" value="{{ $product->kadaluarsa ?? '' }}">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
