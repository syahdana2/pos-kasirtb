@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-5">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3 class="ml-3">{{ $outletCount }}</h3>
              <p>Jumlah Outlet Atau Toko Yang Dimiliki</p>
            </div>
            <div class="icon">
              <i class="ion fa-solid fa-store"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">Jumlah unit toko<i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-5">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3 class="ml-3">{{ $employeeCount }}</h3>
              <p>Jumlah Employee Atau Kasir Toko Saat Ini</p>
            </div>
            <div class="icon">
              <i class="ion fa-solid fa-user-large"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">Jumlah kasir toko<i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <div class="row">
        <div class="col-12">
          <div class="card card-info">
          <div class="d-flex card-header justify-content-center">
              <h3 class="card-title mt-2">Data Outlet atau Toko</h3>
            </div>
            <div class="card-body">
              <div class="my-2">
                <a href="{{ route('outlet.create') }}" class="btn btn-success">
                  <i class="fa-solid fa-plus"></i> Tambah Toko
                </a>
              </div>
              @if(session('success'))
              <div class="alert alert-success" role="alert">
                <i class="fa-regular fa-circle-check mr-2"></i> {{ session('success') }}
              </div>
              @endif
              @if(session('error'))
              <div class="alert alert-danger" role="alert">
                <i class="fa-regular fa-circle-xmark mr-2"></i> {{ session('error') }}
              </div>
              @endif
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                        <tr class="bg-navy">
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="200px">Nama Toko</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="200px">Alamat</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">No Telepon</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Tanggal</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($dt_outlet->count() > 0)
                        @foreach($dt_outlet as $data_outlet)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data_outlet->name_outlet }}</td>
                          <td>{{ $data_outlet->address }}</td>
                          <td>{{ $data_outlet->phone }}</td>
                          <td>{{ $data_outlet->created_at->format('Y-m-d') }}</td>
                          <td>
                            <div class="d-flex gap-1">
                              <a href="{{ route('outlet.show', $data_outlet->id ) }}" class="btn btn-primary text-white"><i class="fa-solid fa-chart-simple mr-2"></i> Detail</a>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td class="text-center" colspan="6">Data toko kosong</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- Modal -->
          </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection