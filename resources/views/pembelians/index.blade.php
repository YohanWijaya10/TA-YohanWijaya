@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Daftar Pembelian</h1>
                <a href="{{ route('pembelians.create') }}" class="btn btn-primary mb-3">Tambah Pembelian</a>
                <div class="table-responsive">
                    <table id="pembelianTable" class="table dataTables table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" style="background-color: purple; color: white;">SKU</th>
                                <th class="text-center" style="background-color: purple; color: white;">Nama Product</th>
                                <th class="text-center" style="background-color: purple; color: white;">Nama Vendor</th>
                                <th class="text-center" style="background-color: purple; color: white;">Tanggal</th>
                                <th class="text-center" style="background-color: purple; color: white;">Jumlah Barang</th>

                                <th class="text-center" style="background-color: purple; color: white;">Total</th>
                                <th class="text-center" style="background-color: purple; color: white;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pembelians as $pembelian)
                                <tr>
                                    <td class="fw-bold text-center" style=" ">{{ $pembelian->sku }}</td>
                                    <td class="fw-bold text-center" style=" text-transform: uppercase;">
                                        {{ $pembelian->product ? $pembelian->product->nama_produk : 'Product tidak ditemukan' }}
                                    </td>
                                    <td class="text-center" style=" text-transform: uppercase;" style=" color: purple;">
                                        @if ($pembelian->vendor)
                                            {{ $pembelian->vendor->nama_vendor }}
                                        @else
                                            Vendor tidak ditemukan
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $pembelian->tanggal }}</td>
                                    <td class="text-center">{{ $pembelian->jumlah_barang }}</td>

                                    <td>Rp
                                        {{ $pembelian->product ? number_format($pembelian->product->harga_jual * $pembelian->jumlah_barang, 2) : '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('pembelians.edit', $pembelian->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('pembelians.destroy', $pembelian->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                        <!--Aku ingin Tambahkan show pembelian -->
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
            $('#pembelianTable').DataTable();
        });
    </script>
@endsection
