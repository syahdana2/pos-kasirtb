@extends('employee.layouts.main')

@section('head')
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $title }}</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col-6">
              <!-- /.card-header -->
              <div class="card">

                <!-- /.card-body -->
                <div class="card-body">
                    {{-- alert --}}
                    @if ($message = Session::get('success'))
                        <div id=".alert" class="alert alert-success col-sm-12 border 0" role="alert" style="background-color: rgba(35, 184, 35, 0.5);">
                          <i class="fa-regular fa-circle-check mr-2"></i>
                          {{ $message }}
                        </div>
                        <script>
                          function hideAlert() {
                              $(".alert").fadeOut('fast');
                          }
                          setTimeout(hideAlert, 5000);
                        </script>
                    @endif
                    <div class="mb-3">
                     <a href="{{ route('add_unit') }}"
                        class="btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success text-light shadow-md"><i
                        class="fa-solid fa-plus mr-2"></i> Tambah satuan</a>
                    </div>
                  <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                          <thead class="">
                          <tr>
                            <th class="sorting sorting_asc " tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >Satuan</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="120px">Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                              @foreach ($data as $satuan)
                                <tr class="odd">
                                  <td class="dtr-control sorting_1 text-center" tabindex="0">{{ $loop->iteration }}</td>
                                  <td>{{ $satuan->satuan }}</td>
                                  <td>
                                    {{-- <a href="{{ route('tampildata', $pelanggan->id) }}" class="btn btn-danger">Edit</a> --}}
                                    <a href="{{ route('data_unit', $satuan->id) }}" class="btn btn-danger">Edit</a>
                                    <a href="{{ route('delete_unit', $satuan->id) }}" type="button" class="btn btn-warning" 
                                      onclick="return confirm('Apkahah anda yakin ingin menghapus {{ $satuan->name }}?')">
                                      Hapus
                                    </a>
                                  </td>
                                </tr>      
                              @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
              
            </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card-body -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('script')
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
  {{-- table search --}}
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["excel", "pdf", "print"]
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
@endsection