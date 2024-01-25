@extends('admin.layouts.app')
@section('title', 'Data Toko')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Toko</h1>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="150px">Aksi</th>
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
                                                            <a href="{{ route('outlet.edit', $data_outlet->id) }}" class="btn btn-warning text-white"><i class="fa-solid fa-pen-to-square mr-2"></i> Edit</a>
                                                            <form action="{{ route('outlet.destroy', $data_outlet->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus toko {{ $data_outlet->name_outlet }}?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fa-solid fa-trash mr-2"></i> Hapus
                                                                </button>
                                                            </form>
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
        </div>
    </section>
</div>
@endsection