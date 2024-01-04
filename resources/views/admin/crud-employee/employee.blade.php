@extends('admin.layouts.app')
@section('title', 'Data Kasir')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kasir</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data kasir yang dimiliki saat ini</h3>
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <a href="{{ route('employee.create') }}" class="btn btn-success">
                                    <i class="fa-solid fa-plus"></i> Tambah Kasir
                                </a>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            <table class="table table-hover table-bordered text-nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>Toko</th>
                                        <th>Nama Kasir</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($dt_employee->count() > 0)
                                    @foreach($dt_employee as $data_employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data_employee->outlet->name_outlet }}</td>
                                        <td>{{ $data_employee->name_employee }}</td>
                                        <td>{{ $data_employee->username }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('employee.edit', $data_employee->id) }}" class="btn btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                <form action="{{ route('employee.destroy', $data_employee->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus data ini')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa-solid fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="6">Data kasir kosong</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection