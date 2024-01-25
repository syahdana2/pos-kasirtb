<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="stylesheet" href="{{asset('css/css.css')}}">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
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
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/summernote/summernote-bs4.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- jquery -->
  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
  <!-- bootsrap -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
</head>

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
      <ul class="navbar-nav ml-auto mr-2">
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
        <span class="brand-text font-weight-light">ADMIN</span>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <div class="d-block text-white">{{ $admin->username }}</div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                <i class="ion fa-solid fa-chart-line"></i>
                <p>
                  Data Transaksi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('outlet') }}" class="nav-link {{ request()->is('admin/outlet') ? 'active' : '' }}">
                <i class="ion fa-solid fa-shop"></i>
                <p>
                  Data Toko
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee') }}" class="nav-link {{ request()->is('admin/employee') ? 'active' : ''}}">
                <i class="ion fa-solid fa-users"></i>
                <p>
                  Data Kasir
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.logout') }}" class="nav-link">
                <i class="ion fa-solid fa-right-from-bracket"></i>
                <p>
                  Logout
                </p>
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
  <script src="{{asset('AdminLTE')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
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
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="{{asset('AdminLTE')}}/dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="{{asset('AdminLTE')}}/dist/js/pages/dashboard.js"></script> -->
  <!-- bootsrap -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <!-- fontawesome -->
  <script src="{{ asset('js/fontawesome.js') }}"></script>
  <!-- <script src="https://kit.fontawesome.com/61b05592ac.js" crossorigin="anonymous"></script> -->
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
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <!-- Include Bootstrap JS in your layout if not included -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Display Bootstrap Toast using JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var toast = new bootstrap.Toast(document.querySelector('.toast'))
      toast.show()
    });
  </script>
</body>

</html>