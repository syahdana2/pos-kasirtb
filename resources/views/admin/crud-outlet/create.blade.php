@extends('admin.layouts.app')
@section('title', 'Tambah Toko')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Toko</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('outlet.store') }}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row mb-3 mx-1">
                                    <label for="name_outlet" class="col-sm-2 col-form-label">Toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name_outlet') is-invalid @enderror" id="name_outlet" name="name_outlet" placeholder="Masukkan nama toko" required value="{{ old('name_outlet') }}">
                                        @error('name_outlet')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="phone" class="col-sm-2 col-form-label">No Telp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Masukkan no telepon toko" required value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="2" name="address" placeholder="Masukkan alamat toko" required>{{ old('address') }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="javascript:window. history. back();" type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> Batal</a>
                                    <button type="submit" class="btn btn-info text-white"><i class="fa-solid fa-plus mr-2"></i> Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection