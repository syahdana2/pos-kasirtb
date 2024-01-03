@extends('employee.layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
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
                            <h3 class="card-title">Data produk yang dimiliki saat ini</h3>
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <a href="{{ route('product.create') }}" class="btn btn-success">
                                    <i class="fa-solid fa-plus"></i> Tambah Produk
                                </a>
                            </div>
                            @if(isset($totalLowStock) && $totalLowStock > 0)
                                <div class="alert alert-warning mt-2" role="alert">
                                    Ada <a href="#" class="alert-link">{{ $totalLowStock }} produk</a> memiliki stok kurang dari 5 atau perlu restock.
                                </div>
                            @endif
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
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Produk</th>
                                        <th>Unit</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($product->count() > 0)
                                    @foreach($product as $data_product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data_product->barcode }}</td>
                                        <td>{{ $data_product->name_product }}</td>
                                        <td>{{ $data_product->satuan_product }}</td>
                                        <td>{{ $data_product->stock }}</td>
                                        <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                                        <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                                        <td>{{ $data_product->employee_name }}</td>
                                        <td width="100px">
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('product.show', $data_product->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></i></a>
                                                <a href="{{ route('product.edit', $data_product->id) }}" class="btn btn-warning text-white" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form action="{{ route('product.destroy', $data_product->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus data ini')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="10">Data produk kosong</td>
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