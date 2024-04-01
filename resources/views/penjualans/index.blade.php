@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Daftar Penjualan</h1>
            <a href="{{ route('penjualans.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>
            
                    <div class="table-responsive">
                        <table id="penjualanTable" class="table dataTables table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color: purple; color: white;">sku</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Nama Product</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Tanggal</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Jumlah Barang</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Total</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualans as $penjualan)
                                <tr>
                                    <td class="fw-bold text-center" style=" ">{{ $penjualan->sku }}</td>
                                    <td class="fw-bold text-center" style=" text-transform: uppercase;">{{ $penjualan->product ? $penjualan->product->nama_produk : 'Product Not Found' }}</td>
                                    <td class="text-center">{{ $penjualan->tanggal }}</td>
                                    <td class="text-center">{{ $penjualan->jumlah_barang }}</td>
                                    <td class="text-center">Rp {{ $penjualan->product ? number_format($penjualan->product->harga_jual * $penjualan->jumlah_barang, 2) : 'Product Not Found' }}</td>
                                    <td>
                                        <a href="{{ route('penjualans.edit', $penjualan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('penjualans.destroy', $penjualan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
             
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#penjualanTable').DataTable();
    });
</script>
@endsection
