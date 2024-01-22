@extends('employee.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- /.card-body -->
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <i class="fa-solid fa-circle-info mr-2"></i> Selain untuk restok, halaman ini juga bisa untuk return jika ada pengembalian produk
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
                            <div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="bg-navy">
                                                    <th width="100px">Kode</th>
                                                    <th width="200px">Produk</th>
                                                    <th width="80px">Unit</th>
                                                    <th width="30px">Stok</th>
                                                    <th width="130px">Restok</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $product->barcode }}</td>
                                                    <td>{{ $product->name_product }}</td>
                                                    <td>{{ $product->unit->satuan }}</td>
                                                    <td>
                                                        @if ($product->stock < 5) <span class="badge text-bg-danger">{{ $product->stock }}</span>
                                                            @else
                                                            <span class="badge text-bg-success">{{ $product->stock }}</span>
                                                            @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('product.editstock', $product->id) }}" method="post">
                                                            @csrf
                                                            <div class="d-flex gap-1">
                                                                <div class="col-md-6">
                                                                    <input type="number" class="form-control" name="restock" id="restock" value="0" min="0">
                                                                </div>
                                                                <button type="submit" class="btn btn-success text-white" title="Pilih"><i class="fa-solid fa-circle-plus"></i> Restock</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mr-3">
                                            <a href="javascript:window. history. back();" type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> Batal</a>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection