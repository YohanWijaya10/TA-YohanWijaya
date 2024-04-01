@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white fw-bold">Total Pendapatan Hari Ini</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($todayIncome, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success text-white fw-bold">Total Pendapatan Kemarin</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($yesterdayIncome, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info text-white fw-bold">Total Pendapatan Minggu Ini</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($weeklyIncome, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card">
                    <div class="card-header bg-warning text-white fw-bold">Total Pendapatan Bulan Ini</div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($monthlyIncome, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white fw-bold">
                        <i class="fas fa-chart-area me-1"></i>
                        Grafik Penjualan Barang Terlaris
                    </div>
                    <div class="card-body">
                        <canvas id="bestSellingChart" width="100%" height="20"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header text-white fw-bold" style="background-color: purple; color: white;">
                            Barang yang Perlu Restock
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th >Nama Produk</th>
                                            <th>Total Barang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productsToRestock as $product)
                                            @if ($product->nama_produk !== null)
                                                <tr>
                                                    <td>{{ $product->nama_produk }}</td>
                                                    <td>{{ $product->jumlah_barang }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination justify-content-center">
                                {{ $productsToRestock->links() }} <!-- Pagination links -->
                            </ul>
                            
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header text-white fw-bold" style="background-color: DarkCyan; color: white;">
                            Barang yang Kadaluarsa
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Tanggal Kadaluarsa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expiredProducts as $product)
                                            @if ($product->nama_produk !== null)
                                                <tr>
                                                    <td>{{ $product->nama_produk }}</td>
                                                    <td>{{ $product->kadaluarsa }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination justify-content-center">
                                {{ $expiredProducts->links() }}
                            </ul>
                            
                        </div>
                    </div>
            </div>
           

            

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('bestSellingChart').getContext('2d');
            var bestSellingData = @json($bestSellingProductsData);

            var labels = bestSellingData.map(function(product) {
                return product['product'].nama_produk;
            });

            var data = bestSellingData.map(function(product) {
                return product['total_barang'];
            });

            var bestSellingChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Barang Terjual',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
