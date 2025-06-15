@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>


    <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2"> 
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Surat Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSuratMasuk }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                        </div>
                    </div>
                      <!-- Tombol Lihat Detail -->
                      <div class="mt-3 text-right" >
                        <a href="{{ route('suratmasuk') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

           <!-- Earnings (Monthly) Card Example -->
           <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Surat Keluar
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jumlahSuratKeluar }}</div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-auto">
                            <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <!-- Tombol Lihat Detail -->
                    <div class="mt-3 text-right" >
                        <a href="{{ route('suratkeluar') }}" class="btn btn-info btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

         <!-- Pending Requests Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Surat Keputusan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSuratKeputusan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas 	fa-file-signature fa-fw fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <!-- Tombol Lihat Detail -->
                    <div class="mt-3 text-right">
                        <a href="{{ route('suratkeputusan') }}" class="btn btn-warning btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

         <!-- Pending Requests Card Example -->
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Disposisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSuratDisposisi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas 	fa-share-square fa-2x text-gray-300"></i>

                        </div>
                    </div>
                    <!-- Tombol Lihat Detail -->
                    <div class="mt-3 text-right">
                        <a href="{{ route('disposisi.index') }}" class="btn btn-secondary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card shadow mb-4 w-100">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Surat Masuk & Keluar (7 Hari Terakhir)</h6>
    </div>
    <div class="card-body">
        <canvas id="suratChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('suratChart').getContext('2d');

    const suratChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartDates) !!},
            datasets: [
                {
                    label: 'Surat Masuk',
                    data: {!! json_encode($chartMasuk) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Surat Keluar',
                    data: {!! json_encode($chartKeluar) !!},
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>


@endsection