@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Add Product</h2>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_produk">Product Name:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                <small id="nama_produk_feedback" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Quantity:</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
            </div>
            <div class="form-group">
                <label for="harga_beli">Buying Price:</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
            </div>
            <div class="form-group">
                <label for="harga_jual">Selling Price:</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
            </div>
            <div class="form-group">
                <label for="kadaluarsa">Tanggal Kadaluarsa:</label>
                <input type="date" class="form-control" id="kadaluarsa" name="kadaluarsa">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#nama_produk').on('input', function(){
            var nama_produk = $(this).val();
            $.ajax({
                url: '{{ route('check-product') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_produk: nama_produk
                },
                success: function(response){
                    if(response.exists){
                        $('#nama_produk_feedback').html('Product already exists.');
                    } else {
                        $('#nama_produk_feedback').html('');
                    }
                }
            });
        });
    });
</script>
@endsection
