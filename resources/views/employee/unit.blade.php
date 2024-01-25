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
      <div class="row ">
        <div class="col-md-12">
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
                <a href="{{ route('add_unit') }}" class="btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success text-light shadow-md"><i class="fa-solid fa-plus mr-2"></i> Tambah satuan</a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importExcel"><i class="fa-solid fa-file-excel mr-2"></i>Import EXCEL</button>
                <a href="{{ route('exportPDF-unit') }}" class="btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-primary text-light shadow-md"><i class="fa-solid fa-file-pdf mr-2"></i>PDF</a>
                <a href="{{ route('exportEXCEL-unit') }}" class="btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-primary text-light shadow-md"><i class="fa-solid fa-file-excel mr-2"></i>EXCEL</a>
              </div>
              
              {{-- notifikasi sukses --}}
              @if (session()->has('sukses'))
                <div id="hide" class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  {{ session('sukses') }}
                </div>
              @endif
          
              <!-- Import Excel -->
              <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{ route('import.unit') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                      </div>
                      <div class="modal-body">
          
                        {{ csrf_field() }}
          
                        <label>Pilih file excel</label>
                        <div class="form-group">
                          <input type="file" class="form-control" name="file" required="required" id="fileInput">
                        </div>
          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"  id="importBtn">Import</button>
                      </div>
                    </div>
                  </form>
                </div>
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
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Satuan</th>
                          <th class="sorting" width="80px" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Id Satuan</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="180px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $satuan)
                        <tr class="odd">
                          <td class="dtr-control sorting_1 text-center" tabindex="0">{{ $loop->iteration }}</td>
                          <td>{{ $satuan->satuan }}</td>
                          <td>{{ $satuan->id }}</td>
                          <td>
                            <a href="{{ route('data_unit', $satuan->id) }}" class="btn btn-warning text-white" title="Edit"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                            <a href="{{ route('delete_unit', $satuan->id) }}" type="button" class="btn btn-danger" onclick="return confirm('Apkahah anda yakin ingin menghapus satuan {{ $satuan->satuan }}?')" title="Hapus">
                              <i class="fa-solid fa-trash mr-2"></i>Hapus
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

