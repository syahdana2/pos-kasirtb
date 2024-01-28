@extends('employee.layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $title }}</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <!-- /.card-body -->
          <div class="card-body">
            @if(isset($totalLowStock) && $totalLowStock > 0)
            <div class="alert alert-warning mt-2" role="alert">
              <i class="fa-solid fa-circle-exclamation mr-2"></i> Ada <a href="{{ route('product.restock') }}" class="alert-link">{{ $totalLowStock }} produk</a> memiliki stok kurang dari minimal stok atau habis
            </div>
            @endif
            @if(session('success'))
            <div id="hide" class="alert alert-success" role="alert">
              <i class="fa-regular fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div id="hide" class="alert alert-danger" role="alert">
              <i class="fa-regular fa-circle-xmark mr-2"></i> {{ session('error') }}
            </div>
            @endif
            <a href="{{ route('product.create') }}" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success shadow-md text-light"><i class="fa-solid fa-plus mr-2"></i>Tambah Produk</a>
            <button type="button" class="btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success shadow-md text-light" data-toggle="modal" data-target="#importExcel"><i class="fa-solid fa-file-excel mr-2"></i>Import Excel</button>
            <a href="{{ route('exportPDF-produk') }}" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-primary shadow-md text-light"><i class="fa-solid fa-file-pdf mr-2 "></i>PDF</a>
            <a href="{{ route('exportEXCEL-produk') }}" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-primary shadow-md text-light"><i class="fa-solid fa-file-excel mr-2 "></i>Excel</a>

            <!-- Import Excel -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('import.products') }}" enctype="multipart/form-data">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">
                      {{ csrf_field() }}
                      <label>Pilih file excel</label>
                      <div class="form-group">
                        <input type="file" name="file" required="required">
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

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
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Min Stok</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Harga Beli</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="90px">Harga Jual</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="120px">Aksi</th>
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
                          @elseif ($data_product->stock > 0 && $data_product->stock <= $data_product->minimal_stock)
                            <span class="badge text-bg-danger">{{ $data_product->stock }}</span>
                            @else
                            <span class="badge text-bg-success">{{ $data_product->stock }}</span>
                            @endif
                        </td>
                        <td>{{ $data_product->minimal_stock }}</td>
                        <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                        <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                        <td>
                          <div class="d-flex gap-1">
                            <a href="{{ route('product.show', $data_product->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('product.edit', $data_product->id) }}" class="btn btn-warning text-white" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('product.updatestock', $data_product->id) }}" class="btn btn-success text-white" title="Restock / Return"><i class="fa-solid fa-square-plus"></i></a>
                            <form action="{{ route('product.destroy', $data_product->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus produk {{ $data_product->name_product }}?')">
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
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
    </div>
  </section>

  <!-- modal import excel -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



@endsection