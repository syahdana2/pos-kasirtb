@extends('employee.layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboardemployee">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- /.card-body -->
                        <div class="card-body">
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
                            <a href="javascript:window. history. back();" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-warning shadow-md text-light"><i class="fa-solid fa-arrow-left mr-2"></i></i>Kembali</a>
                            <a href="javascript: window.location.reload();" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-info shadow-md text-light"><i class="fa-solid fa-arrows-rotate mr-2 "></i>Refresh</a>
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                            <thead>
                                                <tr class="bg-navy">
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Kode</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="200px">Produk</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Unit</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Stok</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Harga Beli</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Harga Jual</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="140px">Restok</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($product->count() > 0)
                                                @foreach($product as $data_product)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">{{ $loop->iteration }}</td>
                                                    <td>{{ $data_product->barcode }}</td>
                                                    <td>{{ $data_product->name_product }}</td>
                                                    <td>{{ $data_product->satuan_product }}</td>
                                                    <td>
                                                        @if ($data_product->stock == 0)
                                                            <span class="badge text-bg-danger">Habis</span>
                                                        @elseif ($data_product->stock < 5)
                                                            <span class="badge text-bg-danger">{{ $data_product->stock }}</span>
                                                        @else
                                                            <span class="badge text-bg-success">{{ $data_product->stock }}</span>
                                                        @endif
                                                    </td>
                                                    <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                                                    <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                                                    <td>
                                                        <form action="{{ route('product.restockproduct', $data_product->id) }}" method="post">
                                                            @csrf
                                                            <div class="d-flex gap-1">
                                                                <div class="col-md-6">
                                                                    <input type="number" class="form-control" name="restock" id="restock" value="0" min="0">
                                                                </div>
                                                                <button type="submit" class="btn btn-success text-white" title="Restock"><i class="fa-solid fa-circle-plus"></i></button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="8">Tidak ada data produk yang memiliki stock sedikit atau perlu restok</td>
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
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection