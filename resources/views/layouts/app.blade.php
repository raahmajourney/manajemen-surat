<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>M Surat UMP</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}"rel="stylesheet"> 

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">M Surat UMP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @role('admin|staf')
            <li class="nav-item {{ $menuDashboard ?? '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            @endrole
   

            <!-- Nav Item - Charts -->
            @role('admin|staf')
           
            <li class="nav-item {{ $menusurat ?? '' }}">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-envelope-open"></i>
                    <span>Transaksi Surat</span></a>
                    <div id="collapsePages" class="collapse {{ $collapseSurat ?? '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item {{ $suratmasuk ?? '' }}" href="{{ route('suratmasuk') }}">Surat Masuk</a>
                            <a class="collapse-item {{ $suratkeluar ?? '' }}" href="{{ route('suratkeluar') }}">Surat Keluar</a>
                            <a class="collapse-item {{ $suratkeputusan ?? '' }}" href="{{ route('suratkeputusan') }}">Surat Keputusan</a>
                        </div>
                    </div>
            </li>
            @endrole

            <!-- Nav Item - Tables -->
            @role('admin|staf')
            <li class="nav-item {{ $menudisposisi ?? '' }}" >
                <a class="nav-link" href="{{ route('disposisi.index') }}">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Disposisi</span></a>
            </li>
            @endrole


            <!-- Divider -->
            @role('dosen|admin|staf')
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item {{ $menuformulir ?? '' }}">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFormulir"
                   aria-expanded="true" aria-controls="collapseFormulir">
                    <i class="fas  fa-file-alt fa-envelope-open"></i>
                    <span>Formulir</span>
                </a>
                <div id="collapseFormulir" class="collapse {{ $collapseFormulir ?? '' }}" aria-labelledby="headingFormulir" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ $Dataformulir ?? '' }}" href="{{ route('dataformulir.index') }}">Data Formulir</a>
                        <a class="collapse-item {{ $templateformulir ?? '' }}" href="{{ route('formulir') }}">Template Formulir</a>
                    </div>
                </div>
            </li>
            @endrole
            

                   
             <!-- Nav Item - Pages Collapse Menu -->
            @role('admin')
            <li class="nav-item {{ $menuunitkerja ?? '' }}">
                <a class="nav-link" href="{{ route('unitkerja') }}" >
                    <i class="fas fa-user-friends fa-fw "></i>
                    <span>Unit Kerja</span>
                </a>
            </li>
            @endrole
            
              <!-- Nav Item - Pages Collapse Menu -->
            @role('admin')
            <li class="nav-item {{ $menupengguna ?? '' }}">
                <a class="nav-link" href="{{ route('user.index') }}" >
                    <i class="fas fa-user fa-fw "></i>
                    <span>Pengguna</span>
                </a>
            </li>
            @endrole


            <!-- Nav Item - Pages Collapse Menu -->
            @role('admin|staf')
            <li class="nav-item {{ $menuLogSurat ?? '' }}">
                <a class="nav-link" href="{{ route('logsurat.index') }}" >
                    <i class="fas fa-file-alt fa-fw "></i>
                    <span>Log Surat</span>
                </a>
            </li>
            @endrole
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

                          <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>     

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}
                                </span>
                                  <img src="{{ asset('img/account.png') }}" alt="Edit" width="22" height="22">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                <div class="badge badge-success justify-content-center d-flex">Admin</div>
                                </a>
                                <a class="dropdown-item" href="{{ route('pengaturan') }}">
                                    <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan
                                </a>

                               <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>


                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Manajemen Surat UMP 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up" ></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih “Logout” di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                    <!-- Tombol logout yang trigger form -->
                    <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    @stack('scripts')    
</body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</html>