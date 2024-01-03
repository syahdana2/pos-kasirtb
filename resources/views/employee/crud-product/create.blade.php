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
              <h3 class="card-title">Tambah Produk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('product.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group row mb-3 mx-1">
                  <label for="name_product" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name_product') is-invalid @enderror" id="name_product" name="name_product" placeholder="Masukkan nama produk" required value="{{ old('name_product') }}">
                    @error('name_product')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="barcode" class="col-sm-2 col-form-label">Kode</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="Masukkan barcode produk" required value="{{ old('barcode') }}">
                    @error('barcode')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="unit_id" class="col-sm-2 col-form-label">Kasir</label>
                  <div class="col-sm-10">
                    <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                      <option selected>--- Pilih Satuan Unit ---</option>
                      @foreach ($unit as $dt_unit)
                      <option value="{{ $dt_unit->id }}" placeholder="--- pilih unit---">{{ $dt_unit->satuan }}</option>
                      @endforeach
                    </select>
                    @error('unit_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Masukkan stok produk" required value="{{ old('stock') }}">
                    @error('stock')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="buy_price" class="col-sm-2 col-form-label">Harga Beli</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('buy_price') is-invalid @enderror" id="buy_price" name="buy_price" placeholder="Masukkan harga beli produk" required value="{{ old('buy_price') }}">
                    @error('buy_price')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="purchase_price" class="col-sm-2 col-form-label">Harga Jual</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price" placeholder="Masukkan harga jual produk" required value="{{ old('purchase_price') }}">
                    @error('purchase_price')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-3 mx-1">
                  <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" placeholder="Masukkan deskripsi produk" required value="{{ old('desc') }}">
                    @error('desc')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
                  <div class="form-group row mb-3 mx-1">
                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="custom-file col-sm-10">
                    <div class="form-group">
                      <div class="custom-file">
                        <label class="custom-file-label" for="image">Pilih Gambar</label>
                        <input type="file" class="custom-file-input" id="image" name="image">
                      </div>
                    </div>
                    <!-- <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}"> -->
                    @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
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