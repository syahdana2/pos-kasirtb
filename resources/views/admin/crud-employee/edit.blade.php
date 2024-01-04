@extends('admin.layouts.app')
@section('title', 'Edit Kasir')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Kasir {{ $employee->name_employee }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('employee.update', $employee->id) }}" method="post" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row mb-3 mx-1">
                                    <label for="outlet_id" class="col-sm-2 col-form-label">Toko</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="outlet_id" name="outlet_id">
                                            <option selected>--- Pilih Toko ---</option>
                                            @foreach ($outlet as $dt_outlet)
                                            <option value="{{ $dt_outlet->id }}">{{ $dt_outlet->name_outlet }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="name_employee" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name_employee') is-invalid @enderror" id="name_employee" name="name_employee" value="{{ $employee->name_employee }}">
                                        @error('name_employee')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $employee->username }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="password" class="col-sm-2 col-form-label">password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ $employee->password }}">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="form-text text-muted">*Biarkan saja jika tidak ingin mengubah password</small>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-info text-white">Tambah</button>
                                    <a href="javascript:window. history. back();" type="submit" class="btn btn-danger">Batal</a>
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