@extends('employee.layouts.main')


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
