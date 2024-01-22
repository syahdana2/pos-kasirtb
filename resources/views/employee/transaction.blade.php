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
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card-header -->
          <div class="card">
            <!-- /.card-body -->
            <div class="card-body">
              @if(isset($totalLowStock) && $totalLowStock > 0)
              <div class="alert alert-warning mt-2" role="alert">
                Ada <a href="{{ route('product.restock') }}" class="alert-link">{{ $totalLowStock }} produk</a> memiliki stok kurang dari 5 atau perlu restock.
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
              <a href="{{ route('history') }}" class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success shadow-md text-light"><i class="fa-solid fa-clock-rotate-left mr-2"></i>History</a>
              <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-cart-shopping mr-2"></i>Keranjang <span class="badge text-bg-secondary">{{ count((array) session('cart')) }}</span></button>
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                        <tr class="bg-navy">
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="60px">Kode</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="200px">Produk</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Unit</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="30px">Stok</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="70px">Harga Beli</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="70px">Harga Jual</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Harga Grosir</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="120px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($product->count() > 0)
                        @foreach($product as $data_product)
                        <tr class="odd">
                          <td>{{ $data_product->barcode }}</td>
                          <td>{{ $data_product->name_product }}</td>
                          <td>{{ $data_product->satuan_product }}</td>
                          <td>
                            @if ($data_product->stock == 0)
                            <span class="badge text-bg-danger">Habis</span>
                            @elseif ($data_product->stock < 5) <span class="badge text-bg-danger">{{ $data_product->stock }}</span>
                              @else
                              <span class="badge text-bg-success">{{ $data_product->stock }}</span>
                              @endif
                          </td>
                          <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                          <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                          <td>
                            <form action="{{ route('cart.add', $data_product->id) }}" method="post">
                              @csrf
                              <input type="number" class="form-control" name="grosir" id="grosir" value="0">
                          </td>
                          <td>
                            <div class="d-flex gap-1">
                              <div class="d-flex">
                                <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1">
                                <button type="submit" class="btn btn-success text-white" title="Pilih"><i class="fa-solid fa-check"></i></button>
                              </div>
                              </form>
                              <a href="{{ route('product.show', $data_product->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></i></a>
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
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">List Pesanan</h5>
            <a href="{{ route('reset.cart') }}" class="btn btn-primary ml-4"><i class="fa-solid fa-rotate-right mr-2"></i>Reset Keranjang</a>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            @if(session('cart'))
            @foreach (session('cart') as $productId => $cart)
            <div class="d-flex">
              <div class=" col-lg-3">
                @if($cart['image'])
                <img src="{{ asset('storage/' .$cart['image']) }}" alt="User Avatar" class="img-fluid shadow mb-3 bg-body-tertiary rounded">
                @else
                <img src="https://cdn-icons-png.flaticon.com/128/5762/5762943.png" alt="User Avatar" class="img-fluid shadow mb-3 bg-body-tertiary rounded">
                @endif
              </div>
              <div class="col-lg-9">
                <div class="d-flex">
                  <div class="row">
                    <p class="mb-2"><b>{{ $cart['name_product'] }}</b></p>
                    <div class="d-flex">
                      <div class="col-md-5">
                        <span class="">Rp.{{ number_format($cart['selling_price_disc']) }}</span>
                      </div>
                      <div class="d-flex col-md-7">
                        <form action="{{ route('cart.update', $productId) }}" method="POST">
                          @csrf
                          @method('PATCH')
                          <div class="d-flex">
                            <input type="number" class="form-control" name="qty" value="{{ $cart['qty'] }}" min="1">
                            <button type="submit" class="btn btn-sm btn-outline-success p-2"><i class="fa-solid fa-check"></i></button>
                          </div>
                        </form>
                        <form action="{{ route('cart.remove', $productId) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger ml-1 p-2"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <div class="d-flex justify-content-center">
              <div class="alert alert-warning" role="alert">
                <i class="fa-solid fa-basket-shopping mr-2"></i>Kosong, Tidak ada produk yang dipilih
              </div>
            </div>
            @endif
          </div>
          <div class="offcanvas-footer mb-3">
            <hr>
            @if(session('additional_cost'))
            <div class="form-group row">
              <label for="additional_cost" class="col-md-5 col-form-label">Biaya Tambahan</label>
              <div class="col-md-7">
                <input type="number" class="form-control" id="additional_cost" name="additional_cost" value="{{ Session::get('additional_cost') }}" readonly>
              </div>
            </div>
            @endif
            <div class="d-flex">
              <div class="col-md-7">
                <h5>Total :<b> Rp. {{ Session::get('subtotal') }}</b></h5>
              </div>
              <div class="col-md-5">
                <a href="{{ route('checkout') }}" class="btn btn-success">Checkout<i class="fa-solid fa-right-long ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection