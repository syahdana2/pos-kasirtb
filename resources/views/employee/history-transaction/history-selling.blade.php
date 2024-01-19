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
                {{-- <div class="card-header">
                  <h3 class="card-title">DataTable with default features</h3>
                </div> --}}

                <!-- /.card-body -->
                <div class="card-body">
                  <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr class="bg-navy">
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Waktu Pembelian</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="150px">Nama Pembelian</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" width="150px">No Transaksi</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" width="150px">Total Harga</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Aksi</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd">
                      <td class="dtr-control sorting_1" tabindex="0">1</td>
                      <td>Firefox 1.0</td>
                      <td>Win 98+ / OSX.2+</td>
                      <td>1.7</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="even">
                      <td class="dtr-control sorting_1" tabindex="0">2</td>
                      <td>Firefox 1.5</td>
                      <td>Win 98+ / OSX.2+</td>
                      <td>1.8</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="odd">
                      <td class="dtr-control sorting_1" tabindex="0">3</td>
                      <td>Firefox 2.0</td>
                      <td>Win 98+ / OSX.2+</td>
                      <td>1.8</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="even">
                      <td class="dtr-control sorting_1" tabindex="0">4</td>
                      <td>Firefox 3.0</td>
                      <td>Win 2k+ / OSX.3+</td>
                      <td>1.9</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="odd">
                      <td class="sorting_1 dtr-control">5</td>
                      <td>Camino 1.0</td>
                      <td>OSX.2+</td>
                      <td>1.8</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="even">
                      <td class="sorting_1 dtr-control">6</td>
                      <td>Camino 1.5</td>
                      <td>OSX.3+</td>
                      <td>1.8</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="odd">
                      <td class="sorting_1 dtr-control">7</td>
                      <td>Netscape 7.2</td>
                      <td>Win 95+ / Mac OS 8.6-9.2</td>
                      <td>1.7</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="even">
                      <td class="sorting_1 dtr-control">8</td>
                      <td>Netscape Browser 8</td>
                      <td>Win 98SE+</td>
                      <td>1.7</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="odd">
                      <td class="sorting_1 dtr-control">9</td>
                      <td>Netscape Navigator 9</td>
                      <td>Win 98+ / OSX.2+</td>
                      <td>1.8</td>
                      <td>A</td>
                      <td>A</td>
                    </tr><tr class="even">
                      <td class="sorting_1 dtr-control">10</td>
                      <td>Mozilla 1.0</td>
                      <td>Win 95+ / OSX.1+</td>
                      <td>1</td>
                      <td>A</td>
                      <td>A</td>
                    </tr></tbody>
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