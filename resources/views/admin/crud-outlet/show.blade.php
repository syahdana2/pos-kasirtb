@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Outlet {{ $outlet->name_outlet }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
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
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalItem['totalTransaction'] }}</h3>

              <p>Jumlah Transaksi</p>
            </div>
            <div class="icon">
              <i class="ion fa-solid fa-cash-register"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalItem['totalCustomer'] }}</h3>

              <p>Pelanggan</p>
            </div>
            <div class="icon">
              <i class="ion fa-solid fa-user"></i>
            </div>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalItem['totalProduct'] }}</h3>

              <p>Total Produk</p>
            </div>
            <div class="icon">
              <i class="ion fa-solid fa-boxes-stacked"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalItem['totalLowStock'] }}</h3>

              <p>Stok Sedikit</p>
            </div>
            <div class="icon">
              <i class="ion fa-solid fa-chart-pie"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>

    <div class="row">
      <div class="d-flex col-md-12 px-4 mt-2">
        <div class="col-md-5">
          <div class="info-box mb-2 bg-light shadow">
            <span class="info-box-icon"><i class="fa-solid fa-calendar-day"></i></span>
            <div class="info-box-content">
              <div class="d-flex justify-content-between">
                <span class="info-box-text">Pemasukan Hari Ini</span>
                <span class="info-box-text"><b>{{ $totalTransaksi['hariIni'] }} Penjualan</b></span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="info-box-number">Rp {{ number_format($subtotalTransaksi['hariIni']) }}</span>
                <span class="info-box-number text-success">+ Rp {{ number_format($totalProfit['hariIni']) }}</span>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box mb-2 bg-light shadow">
            <span class="info-box-icon"><i class="fa-solid fa-calendar-day"></i></span>
            <div class="info-box-content">
              <div class="d-flex justify-content-between">
                <span class="info-box-text">Pemasukan Minggu Ini</span>
                <span class="info-box-number">{{ $totalTransaksi['mingguIni'] }} Penjualan</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="info-box-number">Rp {{ number_format($subtotalTransaksi['mingguIni']) }}</span>
                <span class="info-box-number text-success">+ Rp {{ number_format($totalProfit['mingguIni']) }}</span>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box mb-2 bg-light shadow">
            <span class="info-box-icon"><i class="fa-solid fa-calendar-day"></i></span>
            <div class="info-box-content">
              <div class="d-flex justify-content-between">
                <span class="info-box-text">Pemasukan Bulan Ini</span>
                <span class="info-box-number">{{ $totalTransaksi['bulanIni'] }} Penjualan</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="info-box-number">Rp {{ number_format($subtotalTransaksi['bulanIni']) }}</span>
                <span class="info-box-number text-success">+ Rp {{ number_format($totalProfit['bulanIni']) }}</span>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box mb-2 bg-light shadow">
            <span class="info-box-icon"><i class="fa-solid fa-calendar-day"></i></span>
            <div class="info-box-content">
              <div class="d-flex justify-content-between">
                <span class="info-box-text">Pemasukan Tahun Ini</span>
                <span class="info-box-number">{{ $totalTransaksi['tahunIni'] }} Penjualan</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="info-box-number">Rp {{ number_format($subtotalTransaksi['tahunIni']) }}</span>
                <span class="info-box-number text-success">+ Rp {{ number_format($totalProfit['tahunIni']) }}</span>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-md-7">
          <div class="card card-info">
            <div class="d-flex justify-content-center card-header">
              <h3 class="card-title mt-2">10 produk yang sering dibeli</h3>
            </div>
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed table-striped text-nowrap">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Nama Produk</th>
                    <th>Satuan</th>
                    <th width="30px">Dibeli</th>
                  </tr>
                </thead>
                <tbody>
                  @if($topProduct->count() > 0)
                  @foreach($topProduct as $dt_product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt_product->name_product }}</td>
                    <td>{{ $dt_product->product_unit  }}</td>
                    <td class="text-center">{{ $dt_product->total_qty  }}x</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td class="text-center" colspan="4">Data produk kosong</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 p-2">
      <div class="row ">
        <div class="col-md-12 ">
          <div class="card card-info">
            <div class="d-flex card-header justify-content-center">
              <h3 class="card-title mt-2">Produk yang diedit atau restok dalam bulan ini</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                <thead>
                  <tr class="bg-navy">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="100px">Kode</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="200px">Produk</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Unit</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="30px">Stok</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Harga Beli</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Harga Jual</th>
                  </tr>
                </thead>
                <tbody>
                  @if($updateProduct->count() > 0)
                  @foreach($updateProduct as $data_product)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{ $loop->iteration }}</td>
                    <td>{{ $data_product->barcode }}</td>
                    <td>{{ $data_product->name_product }}</td>
                    <td>{{ $data_product->unit->satuan }}</td>
                    <td>
                      @if ($data_product->stock == 0)
                      <span class="badge text-bg-danger">Habis</span>
                      @elseif ($data_product->stock > 0 && $data_product->stock <= $data_product->minimal_stock)
                        <span class="badge text-bg-danger">{{ $data_product->stock }}</span>
                        @else
                        <span class="badge text-bg-success">{{ $data_product->stock }}</span>
                        @endif
                    </td>
                    <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                    <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td class="text-center" colspan="10">Tidak ada data produk yang di restok atau edit bulan ini</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 p-2">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-danger">
            <div class="d-flex card-header justify-content-center">
              <h3 class="card-title mt-2">Data stok produk kurang dari minimal stock, atau stok produk habis</h3>
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                <thead>
                  <tr class="bg-navy">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Kode</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="200px">Produk</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Unit</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Stok</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Min Stok</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Harga Beli</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Harga Jual</th>
                  </tr>
                </thead>
                <tbody>
                  @if($totalProfit['lowStock']->count() > 0)
                  @foreach($totalProfit['lowStock'] as $data_product)
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
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td class="text-center" colspan="9">Tidak ada data produk yang memiliki stock sedikit atau perlu restok</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 p-2">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-info">
            <div class="d-flex card-header justify-content-center">
              <h3 class="card-title mt-2">Riwayat penjualan hari ini</h3>
            </div>
            <div class="card-body">
              <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                <thead>
                  <tr class="bg-navy">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="180px">Kode Invoice</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Kasir</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Subtotal</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Bayar</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Kembali</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Laba Profit</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="20px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($totalProfit['history']->count() > 0)
                  @foreach($totalProfit['history'] as $historyDetail)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{ $loop->iteration }}</td>
                    <td>{{ $historyDetail->kode_invoice }}</td>
                    <td>{{ $historyDetail->employee_name }}</td>
                    <td>Rp {{ number_format($historyDetail->subtotal) }}</td>
                    <td>Rp {{ number_format($historyDetail->pay) }}</td>
                    <td>Rp {{ number_format($historyDetail->change) }}</td>
                    <td>Rp {{ number_format($historyDetail->labaProfit) }}</td>
                    <td>
                      <div class="d-flex gap-1">
                        <a href="{{ route('detail.show', $historyDetail->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td class="text-center" colspan="8">Data transaksi kosong</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="row p-2">
      <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
          <i class="fa-solid fa-circle-exclamation mr-2"></i>Hati-hati halaman ini untuk mereset semua data pada toko ini, silahkan export dahulu jika akan reset data
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-danger"><i class="fa-solid fa-database"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-center"><b>Produk</b></span>
            <form action="{{ route('reset.product', $outlet->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin mereset data produk toko {{ $outlet->name_outlet }}?')">
              @csrf
              <button type="submit" class="btn btn-warning"><i class="fa-solid fa-repeat mr-2"></i>Reset Data</button>
            </form>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-danger"><i class="fa-solid fa-cart-shopping"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-center"><b>Transaksi</b></span>
            <form action="{{ route('reset.transaction', $outlet->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin mereset data transaksi toko {{ $outlet->name_outlet }}?')">
              @csrf
              <button class="btn btn-warning"><i class="fa-solid fa-repeat mr-2"></i>Reset Data</button>
            </form>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-danger"><i class="fa-solid fa-user"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-center"><b>Pelanggan</b></span>
            <form action="{{ route('reset.customer', $outlet->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin ingin mereset data pelanggan toko {{ $outlet->name_outlet }}?')">
              @csrf
              <button class="btn btn-warning"><i class="fa-solid fa-repeat mr-2"></i>Reset Data</button>
            </form>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>

  </section>
</div>
<!-- /.content-wrapper -->

@endsection