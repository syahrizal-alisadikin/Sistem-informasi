<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/shop-2.png') }}" type="image/x-icon">

  <title>{{ $title ?? config('app.name') }} - Admin</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
    .form-control:focus {
      color: #6e707e;
      background-color: #fff;
      border-color: #375dce;
      outline: 0;
      box-shadow: none
    }
    .form-group label {
      font-weight: bold
    }
    #wrapper #content-wrapper {
      background-color: #e2e8f0;
      width: 100%;
      overflow-x: hidden;
    }
    .card-header {
      padding: .75rem 1.25rem;
      margin-bottom: 0;
      background-color: #4e73de;
      border-bottom: 1px solid #e3e6f0;
      color: white;
    }
  </style>

  <!-- jQuery -->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>  
  <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- sweet alert -->
  <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          {{-- <i class="fab fa-apple"></i> --}}
        </div>
        <div class="sidebar-brand-text mx-3">Apache Surf</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::is('admin/dashboard*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>DASHBOARD</span></a>
      </li>

      <li class="nav-item {{ Request::is('admin/kelas*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('kelas.index') }}">
        <i class="fas fa-book"></i>
        <span>KELAS</span>
      </a>
    </li>
    <li class="nav-item {{ Request::is('admin/transaction*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{route('transaction.index')}}">
          <i class="fas fa-dollar-sign"></i>
          <span>TRANSACTIONS</span></a>
      </li>

     <li class="nav-item {{ Request::is('admin/materi*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('materi.index') }}">
        <i class="fas fa-book"></i>
        <span>MATERI</span>
      </a>
    </li>

    <li class="nav-item {{ Request::is('admin/includes*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('includes.index') }}">
        <i class="fas fa-tasks"></i>
        <span>INCLUDES</span>
      </a>
    </li>
     <li class="nav-item {{ Request::is('admin/customer*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('customer.index') }}">
          <i class="fas fa-users"></i>
          <span>CUSTOMERS</span>
        </a>
    </li>

      

    

    {{-- <li class="nav-item {{ Request::is('admin/user*') ? ' active' :  '' }}">
      <a class="nav-link" href="{{ route('admin.user.index') }}">
          <i class="fas fa-users"></i>
          <span>USERS</span>
        </a>
    </li> --}}

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

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  LOGOUT
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->
 <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Ingin Keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Silahkan pilih "Logout" di bawah untuk mengakhiri sesi saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            {{-- <span>Hak Cipta Dilindungi &copy; 2020 Developed By Syahrizal As </span> --}}
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
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Ingin Keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Silahkan pilih "Logout" di bawah untuk mengakhiri sesi saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div> --}}

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script> --}}

  <script>
    //sweetalert for success or error message
    @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('info'))
        swal({
            type: "info",
            icon: "info",
            title: "INFO!",
            text: "{{ session('info') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
  </script>
</body>
</html>