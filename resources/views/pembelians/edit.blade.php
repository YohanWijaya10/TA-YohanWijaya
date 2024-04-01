@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Edit Purchase</h2>
        <form action="{{ route('pembelians.update', $pembelian->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_id">Product:</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $pembelian->product_id ? 'selected' : '' }}>{{ $product->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Date:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pembelian->tanggal }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Quantity:</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="{{ $pembelian->jumlah_barang }}" required>
            </div>
            <div class="form-group">
                <label for="vendor_id">Vendor:</label>
                <select class="form-control" id="vendor_id" name="vendor_id" required>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ $vendor->id == $pembelian->vendor_id ? 'selected' : '' }}>{{ $vendor->nama_vendor }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
