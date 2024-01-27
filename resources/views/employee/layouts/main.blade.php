<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="stylesheet" href="{{asset('css/css.css')}}">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/summernote/summernote-bs4.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- bootsrap -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- modal import excel -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
  #reader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
    /* Sesuaikan lebar div sesuai kebutuhan Anda */
    margin-top: 10rem;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{asset('AdminLTE')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <div class="brand-link">
        <img src="{{asset('AdminLTE')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
          {{ \App\Models\Outlet::find(session('outlet_id'))->name_outlet ?? 'Default Outlet Name' }}
        </span>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (profile employee) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <div class="d-block text-white"><span>Kasir </span> {{ $emp->name_employee ?? 'Guest' }}</div>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
              <a href="{{ route('employee.dashboard') }}" class="nav-link {{ ( $title === "Dashboard Employee" ? 'active' : '' ) }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('transaction') }}" class="nav-link {{ ( $title === "Transaksi" ? 'active' : '' ) }}">
                <i class="ml-1 mr-2 fa-solid fa-cart-shopping"></i>
                <p>
                  Transaksi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product') }}" class="nav-link {{ $title === "Data Produk" ? 'active' : '' }}">
                <i class="ml-2 mr-2 fa-solid fa-database"></i>
                <p>
                  Data Produk
                  @if(isset($totalLowStock) && $totalLowStock > 0)
                  <span class="badge badge-warning right">{{ $totalLowStock }}</span>
                  @endif
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('unit_page') }}" class="nav-link {{ ( $title === "Satuan" ? 'active' : '' ) }}">
                <i class="ml-2 fa-solid fa-tag mr-2"></i>
                <p>
                  Unit
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('history') }}" class="nav-link {{ ( $title === "Riwayat Penjualan" ? 'active' : '' ) }}">
                <i class="ml-2 fa-solid fa-clock-rotate-left mr-2"></i>
                <p>
                  Riwayat Penjualan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('customer_page') }}" class="nav-link {{ ( $title === "Pelanggan" ? 'active' : '' ) }}">
                <i class="ml-2 mr-2 fa-solid fa-user"></i>
                <p>
                  Pelanggan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.logout') }}" class="nav-link">
                <div class="my-1">
                  <i class="ml-1 nav-icon fa-solid fa-right-from-bracket"></i>
                  <p>
                    Logout
                  </p>
                </div>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    @yield('content')


    <footer class="main-footer">
      <strong>O&O DEV &copy; 2023-2024.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/jquery-ui/jquery-ui.min.js"></script> -->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- ChartJS -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/chart.js/Chart.min.js"></script> -->
  <!-- Sparkline -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/sparklines/sparkline.js"></script> -->
  <!-- JQVMap -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/jqvmap/jquery.vmap.min.js"></script> -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
  <!-- jQuery Knob Chart -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/jquery-knob/jquery.knob.min.js"></script> -->
  <!-- daterangepicker -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/moment/moment.min.js"></script> -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/daterangepicker/daterangepicker.js"></script> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
  <!-- Summernote -->
  <!-- <script src="{{asset('AdminLTE')}}/plugins/summernote/summernote-bs4.min.js"></script> -->
  <!-- overlayScrollbars -->
  <script src="{{asset('AdminLTE')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('AdminLTE')}}/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="{{asset('AdminLTE')}}/dist/js/pages/dashboard.js"></script> -->
  <!-- bootsrap -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <!-- fontawesome -->
  <script src="{{ asset('js/fontawesome.js') }}"></script>
  <!-- <script src="https://kit.fontawesome.com/7c21a511e6.js" crossorigin="anonymous"></script> -->
  <!-- DataTables  & Plugins -->
  <script src="{{asset('AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- modal import excel -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": []
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>
  <script>
    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const ofReader = new FileReader();
      ofReader.readAsDataURL(image.files[0]);

      ofReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
  </script>
  <script>
    function hideAlert(alertId) {
      $(alertId).fadeOut('fast');
    }
    setTimeout(function() {
      hideAlert("#hide")
    }, 5000);
  </script>
  <script>
    $(document).ready(function () {
        // Ambil url saat ini
        var currentUrl = window.location.href;

      // Periksa apakah URL mengandung kata 'transaksi'
      if (currentUrl.includes('transaksi')) {
        // Menutup sidebar
        $('body').addClass('sidebar-collapse');
      }
    });
  </script>
</body>

</html>