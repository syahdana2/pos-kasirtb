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
              {{-- alert --}}
              @if ($message = Session::get('success'))
              <div id="hide" class="alert alert-success" role="alert">
                <i class="fa-regular fa-circle-check mr-2"></i>
                {{ $message }}
              </div>
              @endif
              <div class="mb-3">
                <a href="{{ route('add_customer') }}" class="btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success text-light shadow-md"><i class="fa-solid fa-plus mr-2"></i> Tambah Pelanggan</a>
              </div>
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead class="">
                        <tr>
                          <th class="sorting sorting_asc " tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="150px">Nama Pelanggan</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" width="80px">No telepon</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="200px">Alamat</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" width="80px">Dibuat</th>
                          <th class="text-center sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="100px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $pelanggan)
                        <tr class="odd">
                          <td class="dtr-control sorting_1 text-center" tabindex="0">{{ $loop->iteration }}</td>
                          <td>{{ $pelanggan->name }}</td>
                          <td>{{ $pelanggan->phone }}</td>
                          <td>{{ $pelanggan->address }}</td>
                          <td>{{ $pelanggan->created_at->format('d M Y') }}</td>
                          <td>
                            <a href="{{ route('customer.show', $pelanggan->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('data_customer', $pelanggan->id) }}" class="btn btn-warning text-white" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('delete_customer', $pelanggan->id) }}" type="button" class="btn btn-danger" onclick="return confirm('Apkahah anda yakin ingin menghapus {{ $pelanggan->name }}?')" title="Hapus">
                              <i class="fa-solid fa-trash"></i>
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