@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Vendor</h1>
            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_vendor">Vendor Name:</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{ $vendor->nama_vendor }}" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">Phone Number:</label>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ $vendor->no_telepon }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Address:</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $vendor->alamat }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
