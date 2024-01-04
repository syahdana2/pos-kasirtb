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
      <div class="row">
          <div class="col-12">
              <!-- /.card-header -->
              <div class="card">
                <!-- /.card-body -->
                <div class="card-body">
                  <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                    </div>
                    <div class="row">
                      <button type="button" class="btn btn-outline-success mr-20">Success</button>
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead class="bg-navy">
                          <tr>
                            <th class="" width="30px">Pilih</th>
                            <th>Nama Produk</th>
                            <th class="" width="120px">Kode Produk</th>
                            <th class="" width="20px">Stok</th>
                            <th class="" width="80px">Harga Beli</th>
                            <th class="" width="80px">Harga Jual</th>
                            <th class="" width="250px">Catatan</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>11</td>
                            <td>Internet
                              Explorer 4.0
                            </td>
                            <td>Win 95+</td>
                            <td> 4</td>
                            <td>X</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>12</td>
                            <td>Internet Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td>5</td>
                            <td>C</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td>Internet
                              Explorer 5.5
                            </td>
                            <td>Win 95+</td>
                            <td>5.5</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Internet
                              Explorer 6
                            </td>
                            <td>3</td>
                            <td>6</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Internet Explorer 7</td>
                            <td>Win XP SP2+</td>
                            <td>7</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>AOL browser (AOL desktop)</td>
                            <td>Win XP</td>
                            <td>6</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Firefox 1.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.7</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Firefox 1.5</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>Firefox 2.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>Firefox 3.0</td>
                            <td>Win 2k+ / OSX.3+</td>
                            <td>1.9</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>Camino 1.0</td>
                            <td>OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>X</td>
                            <td>X</td>
                          </tr>
                          </tbody>
                        </table>
                </div>
              </div>
            </div>
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
@endsection