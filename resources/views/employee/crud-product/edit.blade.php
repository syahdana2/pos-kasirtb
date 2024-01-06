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
                            <h3 class="card-title">Detail Produk {{ $product->name_product }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('product.update', $product->id ) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3 mx-1">
                                    <div class="filtr-item col-sm-4" data-category="2, 4" data-sort="black sample">
                                        @if($product->image)
                                        <img src="{{ asset('storage/' .$product->image) }}" class="img-fluid shadow mb-3 bg-body-tertiary rounded" alt="{{ $product->image }}">
                                        @else
                                        <div class="alert alert-warning text-center" role="alert">
                                            Produk ini tidak menginputkan gambar
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="barcode" class="col-sm-2 col-form-label">Kode Produk</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="name_product" class="col-sm-2 col-form-label">Nama Produk</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_product" name="name_product" value="{{ $product->name_product }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="unit_id" class="col-sm-2 col-form-label">Unit Satuan</label>
                                    <div class="col-sm-10">
                                        <!-- <input type="text" class="form-control" id="unit" name="unit" value="{{ $product->unit->satuan }}"> -->
                                        <select class="form-select" id="unit_id" name="unit_id">
                                            @foreach ($unit as $dt_unit)
                                            <option value="{{ $dt_unit->id }}" {{ $product->unit_id == $dt_unit->id ? 'selected' : '' }}>
                                                {{ $dt_unit->satuan }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="buy_price" class="col-sm-2 col-form-label">Harga Beli</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="buy_price" name="buy_price" value="{{ $product->buy_price }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="selling_price" class="col-sm-2 col-form-label">Harga Jual</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}">
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea name="desc" class="form-control" id="desc" name="desc" rows="3">{{ $product->desc }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-3 mx-1">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="oldImage" value="{{ $product->image }}">
                                        <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                                        <small class="form-text text-muted">*Disarankan Upload gambar maksimal 2 mb</small>
                                        <div class="d-flex justify-content-start my-2">
                                            <div class="filtr-item col-sm-4" data-category="2, 4" data-sort="black sample">
                                                    <img class="img-preview img-fluid shadow bg-body-tertiary rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mr-3">
                                    <a href="javascript:window. history. back();" type="submit" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> Batal</a>
                                    <button type="submit" class="btn btn-info text-white"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
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