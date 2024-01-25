@extends('employee.layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 mt-4">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Edit Satuan {{ $data->satuan }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/employee/satuan/update-unit/{{ $data->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-3 mx-1">
                  <label for="satuan" class="col-sm-3 col-form-label">Jenis Satuan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukan jenis satuan" value="{{ $data->satuan }}" required>
                  </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mr-3">
                  <a href="{{ route('unit_page') }}" type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-left mr-2"></i>Batal</a>
                  <button type="submit" class="btn btn-info text-white"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
@endsection