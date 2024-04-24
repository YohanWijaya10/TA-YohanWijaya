@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Add Purchase</h2>
        <form action="{{ route('pembelians.store') }}" method="POST">
            @csrf
            
            
            <div class="form-group">
                <label for="product">Product:</label>
                <select class="form-control" id="product" name="product_id" required onchange="updateTotal()">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->harga_jual }}">{{ $product->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Price:</label>
                <input type="text" class="form-control" id="harga" name="harga" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal">Date:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Quantity:</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required onchange="updateTotal()">
            </div>
            
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>
            <div class="form-group">
                <label for="vendor">Vendor:</label>
                <select class="form-control" id="vendor" name="vendor_id" required>
                    <option value="">Select Vendor</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                    @endforeach
                </select>
            </div>            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    function updateTotal() {
        var productId = document.getElementById('product').value;
        var harga = document.querySelector('#product option[value="' + productId + '"]').getAttribute('data-price');
        var jumlahBarang = document.getElementById('jumlah_barang').value;
        var total = parseFloat(harga) * parseInt(jumlahBarang);
        document.getElementById('harga').value = "Rp " + parseFloat(harga).toFixed(2);
        document.getElementById('total').value = "Rp " + total.toFixed(2);
    }
</script>
@endsection