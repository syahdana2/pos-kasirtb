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
                      <div class="col-sm-12">
                        <div class="card card-info">
                            <div class="card-header">
                              <h3 class="card-title">Data Pelanggan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/employee/pelanggan/update-pelanggan/{{ $data->id }}" method="post">
                              @csrf
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Pelanggan</label>
                                  <input type="text" name="name" value="{{ $data->name }}" class="form-control" id="exampleInputEmail1" placeholder="Masukan nama">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Nomer telepon</label>
                                  <input type="number" name="phone" value="{{ $data->phone }}" class="form-control" id="exampleInputPassword1" placeholder="Masukan nomer telepon">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Alamat</label>
                                  <input type="text" name="address" value="{{ $data->address }}" class="form-control" id="exampleInputPassword1" placeholder="Masukan alamat">
                                </div>
                              </div>
                              <!-- /.card-body -->
              
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href={{ route('customer_page') }} type="submit" class="btn bg-danger">Batal</a>
                              </div>
                            </form>
                          </div>
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
