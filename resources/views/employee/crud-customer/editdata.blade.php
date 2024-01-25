@extends('employee.layouts.main')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-4">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Detail Pelanggan {{ $data->name }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{ route('update_customer', $data->id) }}" method="post">
                @csrf
                <div class="form-group row mb-3 mx-1">
                  <label for="name" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="phone" class="col-sm-2 col-form-label">No Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}">
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="note" class="col-sm-2 col-form-label">Catatan</label>
                  <div class="col-sm-10">
                    <textarea name="note" class="form-control" id="note" name="note" rows="3">{{ $data->note }}</textarea>
                  </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mr-3">
                  <a href="{{ route('customer_page') }}" type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-left mr-2"></i>Batal</a>
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