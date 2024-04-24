@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Add Sale</h2>
        <form action="{{ route('penjualans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_id">Product:</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        @if($product->jumlah_barang != 0)
                        <option value="{{ $product->id }}" data-price="{{ $product->harga_jual }}" data-stock="{{ $product->jumlah_barang }}">{{ $product->nama_produk }}</option>

                        @endif
                    @endforeach
                </select>
                
                
            </div>
            <div class="form-group">
                <label for="tanggal">Date:</label>
                @php
                    $today = date("Y-m-d");
                @endphp
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $today }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_barang">Quantity:</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                <small class="text-danger" id="stockError" style="display: none;">Product stock is insufficient.</small>
            </div>
            
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var productSelect = document.getElementById('product_id');
            var quantityInput = document.getElementById('jumlah_barang');
            var totalInput = document.getElementById('total');

            function calculateTotal() {
                var productId = productSelect.value;
                var quantity = quantityInput.value;
                var price = productSelect.options[productSelect.selectedIndex].getAttribute('data-price');

                if (productId && quantity && price) {
                    var total = parseInt(price) * parseInt(quantity);
                    totalInput.value = 'Rp ' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                } else {
                    totalInput.value = '';
                }
            }

            productSelect.addEventListener('change', calculateTotal);
            quantityInput.addEventListener('input', calculateTotal);

            // Calculate total on page load if values are already selected
            calculateTotal();
        });
    </script>
    <script>
        document.getElementById('jumlah_barang').addEventListener('change', function() {
    var jumlah_barang = parseInt(this.value);
    var productOption = document.getElementById('product_id').options[document.getElementById('product_id').selectedIndex];
    var stok_produk = parseInt(productOption.getAttribute('data-stock'));

    if (jumlah_barang > stok_produk) {
        document.getElementById('stockError').style.display = 'block';
        alert('Product stock is insufficient. Please reduce the quantity.');
    } else {
        document.getElementById('stockError').style.display = 'none';
    }
});

    </script>
    
    

</div>
@endsection
