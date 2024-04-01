@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Laporan</h1>
    </div>
    <div class="row mt-2">
        <div class="col-md-4 mt-1">
            
                    <h5 class="card-title">Filter Tanggal</h5>
                    <form action="{{ route('laporan') }}" method="GET" class="row g-2 align-items-center mt-1">
                        <div class="col-4">
                            <label for="start_date" class="visually-hidden">Tanggal Awal:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                        </div>
                        <div class="col-4">
                            <label for="end_date" class="visually-hidden">Tanggal Akhir:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
               
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white fw-bold">
                    Total Pendapatan
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($totalPendapatan, 2) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header  bg-success text-white fw-bold">
                    Total Pendapatan Bersih
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($pendapatanBersih, 2) }}</h5>
                </div>
            </div>
        </div>
        
        
        
        
    </div>
    
    
    
    <div class="row mt-4">
        <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="laporanPenjualanTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color: purple; color: white;">Nama Product</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Tanggal</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Jumlah Barang</th>
                                    <th class="text-center" style="background-color: purple; color: white;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporanPenjualan as $penjualan)
                                <tr>
                                    <td class="fw-bold text-center" style=" text-transform: uppercase;">
                                        @if ($penjualan->product)
                                            {{ $penjualan->product->nama_produk }}
                                        @else
                                            Produk tidak ditemukan
                                        @endif
                                    </td>                        
                                    <td class="text-center">{{ $penjualan->tanggal }}</td>
                                    <td class="text-center">{{ $penjualan->jumlah_barang }}</td>
                                    <td class="text-center">
                                        @if ($penjualan->product)
                                            Rp {{ number_format($penjualan->jumlah_barang * $penjualan->product->harga_jual, 2) }}
                                        @else
                                            Produk tidak ditemukan
                                        @endif
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
        $('#laporanPenjualanTable').DataTable();
    });
</script>
@endsection
