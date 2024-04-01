@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Product List</h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>


                @if ($products->isEmpty())
                    <p class="text-center">No products found.</p>
                @else
                    <div class="table-responsive">
                        <table id="productTable" class="table dataTables table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color: purple; color: white;">sku</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Name</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Quantity</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Buying Price
                                    </th>
                                    <th class="text-center" style="background-color: purple; color: white;">Selling Price
                                    </th>
                                    <th class="text-center" style="background-color: purple; color: white;">Expiration Date
                                    </th> <!-- Tambah kolom kadaluarsa -->
                                    <th class="text-center" style="background-color: purple; color: white;" width="150px">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    @php
                                        $expirationDate = $product->kadaluarsa
                                            ? \Carbon\Carbon::parse($product->kadaluarsa)
                                            : null;
                                        $today = \Carbon\Carbon::today();
                                        $isExpired = $expirationDate && $expirationDate->isPast();
                                    @endphp
                                    <tr>
                                        <td class="fw-bold text-center{{ $isExpired ? ' text-danger' : '' }}">
                                            {{ $product->sku }}</td>
                                        <td class="fw-bold text-center{{ $isExpired ? ' text-danger' : '' }}"
                                            style="text-transform: uppercase;">{{ $product->nama_produk }}</td>
                                        <td class="text-center{{ $isExpired ? ' text-danger' : '' }}">
                                            {{ $product->jumlah_barang }}</td>
                                        <td class="text-center{{ $isExpired ? ' text-danger' : '' }}">Rp
                                            {{ number_format($product->harga_beli, 2) }}</td>
                                        <td class="text-center{{ $isExpired ? ' text-danger' : '' }}">Rp
                                            {{ number_format($product->harga_jual, 2) }}</td>
                                        <td class="text-center{{ $isExpired ? ' text-danger' : '' }}">
                                            {{ $expirationDate ? $expirationDate->format('d/m/Y') : 'N/A' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>
@endsection
