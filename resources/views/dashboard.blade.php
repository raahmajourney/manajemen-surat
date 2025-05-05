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
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
                            <i class="fas fa-user fa-fw fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

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

@endsection