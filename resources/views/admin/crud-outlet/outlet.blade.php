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
                        <div class="card-header">
                            <h3 class="card-title">Data toko yang dimiliki saat ini</h3>
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
                            <table class="table table-hover table-bordered text-nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>Nama Toko</th>
                                        <th width="400px">Alamat</th>
                                        <th>No Telp Toko</th>
                                        <th>Dibuat Tanggal</th>
                                        <th>Aksi</th>
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
                                                <a href="{{ route('outlet.edit', $data_outlet->id) }}" class="btn btn-warning text-white"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                <form action="{{ route('outlet.destroy', $data_outlet->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus data ini')">
                                                <!-- <form action="/admin/outlet/delete{{ $data_outlet->id }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus data ini')"> -->
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
                                        <td class="text-center" colspan="6">Data toko kosong</td>
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
</div>
@endsection