@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>Purchase Detail</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Product:</th>
                        <td>{{ $pembelian->product ? $pembelian->product->nama_produk : 'Product not found' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Date:</th>
                        <td>{{ $pembelian->tanggal }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Quantity:</th>
                        <td>{{ $pembelian->jumlah_barang }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Vendor:</th>
                        <td>{{ $pembelian->vendor ? $pembelian->vendor->nama_vendor : 'Vendor not found' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
