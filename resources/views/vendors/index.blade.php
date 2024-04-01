<!-- DataTables CSS -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>Daftar Vendor</h1>
            <a href="{{ route('vendors.create') }}" class="btn btn-primary mb-3">Tambah Vendor</a>
            <table id="vendorTable" class="table dataTables table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: purple; color: white;">sku</th>
                        <th class="text-center" style="background-color: purple; color: white;">Nama Vendor</th>
                        <th class="text-center" style="background-color: purple; color: white;">No. Telepon</th>
                        <th class="text-center" style="background-color: purple; color: white;">Alamat</th>
                        <th class="text-center" style="background-color: purple; color: white;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $vendor)
                    <tr>
                        <td class="fw-bold text-center" style=" ">{{ $vendor->sku }}</td>
                        <td class="fw-bold text-center" style=" text-transform: uppercase;">{{ $vendor->nama_vendor }}</td>
                        <td class="text-center">{{ $vendor->no_telepon }}</td>
                        <td class="text-center">{{ $vendor->alamat }}</td>
                        <td >
                            <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
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


@endsection
