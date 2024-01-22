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
              @if(isset($totalLowStock) && $totalLowStock > 0)
              <div class="alert alert-warning mt-2" role="alert">
              <i class="fa-solid fa-exclamation mr-2"></i> Ada <a href="{{ route('product.restock') }}" class="alert-link">{{ $totalLowStock }} produk</a> memiliki stok kurang dari 5 atau perlu restock.
              </div>
              @endif
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
              <a href="{{ route('product.create') }}" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success shadow-md text-light"><i class="fa-solid fa-plus mr-2"></i>Tambah</a>
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
                            @elseif ($data_product->stock < 5)
                                <span class="badge text-bg-danger">{{ $data_product->stock }}</span>
                            @else
                                <span class="badge text-bg-success">{{ $data_product->stock }}</span>
                            @endif
                          </td>
                          <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                          <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                          <td>
                            <div class="d-flex gap-1">
                              <a href="{{ route('product.show', $data_product->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></i></a>
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
    </div>
  </div>
</div>

@endsection