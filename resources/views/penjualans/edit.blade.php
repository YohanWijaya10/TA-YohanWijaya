@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Edit Sale</h2>
        <form action="{{ route('penjualans.update', $penjualan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_id">Product:</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $penjualan->product_id ? 'selected' : '' }}>{{ $product->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Date:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $penjualan->tanggal }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Quantity:</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="{{ $penjualan->jumlah_barang }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
