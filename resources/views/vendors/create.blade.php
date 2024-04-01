@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add Vendor</h1>
            <form action="{{ route('vendors.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_vendor">Vendor Name:</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">Phone Number:</label>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Address:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
