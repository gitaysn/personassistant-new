<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>V-Person Assistant - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">



    <style>
        .sidebar {
            position: relative;

        }

        .bg-gradient-green {
            background-color: #43a047 !important;
            /* hijau medium */
            background-image: linear-gradient(180deg, #388e3c 10%, #4caf50 100%) !important;
            background-size: cover;
        }

        /* Hilangkan jarak antar item sidebar */
        #accordionSidebar .nav-item {
            margin-bottom: 2px !important;
        }

        /* Kurangi padding di dalam link */
        #accordionSidebar .nav-link {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-green sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center logo-custom mt-3 mb-3" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text">SPK V-Person Assistant</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Data Kriteria -->
            <li class="nav-item {{ request()->is('admin/kriteria') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.kriteria.index') }}">
                    <i class="bi bi-box"></i>
                    <span>Data Kriteria</span></a>
            </li>

            <!-- Nav Item - Data Sub Kriteria (Collapse) -->
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->is('admin/kriteria/subkriteria/*') ? '' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseSubkriteria"
                    aria-expanded="{{ request()->is('admin/kriteria/subkriteria/*') ? 'true' : 'false' }}"
                    aria-controls="collapseSubkriteria" style="font-size: 0.9rem; padding: 0.5rem 1rem;">
                    <div>
                        <i class="bi bi-boxes me-2"></i>
                        <span>Data Sub Kriteria</span>
                    </div>
                    <i class="bi bi-chevron-down small"></i>
                </a>

                <div id="collapseSubkriteria"
                    class="collapse {{ request()->is('admin/kriteria/subkriteria/*') ? 'show' : '' }}">
                    <div class="bg-white ps-2 py-1 rounded-2">
                        @php
                            use App\Models\Kriteria;
                            $kriterias = Kriteria::with('subKriteria')->get();
                        @endphp

                        @foreach ($kriterias as $kriteria)
                            <a href="{{ route('admin.kriteria.subkriteria.index', ['nama_kriteria' => $kriteria->nama_kriteria]) }}"
                                class="d-block nav-link {{ request()->is('admin/kriteria/subkriteria/' . $kriteria->nama_kriteria) ? 'fw-bold text-dark' : 'text-dark' }}"
                                style="font-size: 0.82rem; padding: 3px 6px; line-height: 1.2;">
                                <i class="bi bi-chevron-right small me-1"></i>{{ $kriteria->nama_kriteria }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </li>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let collapseMenu = document.getElementById("collapsePages");
                    let collapseToggle = document.querySelector("[data-target='#collapsePages']");

                    // Cek status collapse di localStorage
                    let isOpen = localStorage.getItem("collapsePages") === "open";

                    // Tunggu sebentar sebelum menyesuaikan tampilan (menghindari Bootstrap override)
                    setTimeout(() => {
                        if (isOpen) {
                            collapseMenu.classList.add("show");
                        } else {
                            collapseMenu.classList.remove("show");
                        }
                    }, 50); // Delay kecil untuk menghindari efek flicker

                    // Event listener untuk tombol collapse
                    collapseToggle.addEventListener("click", function() {
                        isOpen = !collapseMenu.classList.contains("show");
                        localStorage.setItem("collapsePages", isOpen ? "open" : "closed");
                    });
                });
            </script>

            <!-- Nav Item - Alternatif -->
            <li class="nav-item {{ request()->is('admin/pakaian') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pakaian.index') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Data Pakaian</span></a>
            </li>

            <!-- Nav Item - Penilaian -->
            <li class="nav-item {{ request()->is('admin/penilaian') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.penilaian.index') }}">
                    <i class="bi bi-calculator"></i>
                    <span>Penilaian</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

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

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Admin
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('/assets/img/profile.svg') }}">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <!-- Profile Link -->
                                <a class="dropdown-item" href="{{ route('admin.user.show', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>


                                <!-- Logout Link -->
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

                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Apakah Anda yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pilih "Logout" di bawah ini jika anda siap mengakhiri sesi anda
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"
                        style="background-color: #90ee90; color: black; border-color: #90ee90;">
                        Batal
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn"
                            style="background-color: #064e03; border-color: #064e03; color: white;">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/assets/js/sb-admin-2.min.js') }}"></script>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
