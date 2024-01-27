<!DOCTYPE html>
<html>
    <head>
    <!-- bootsrap -->
  {{-- <link rel="stylesheet" src="../../../../public/css/bootstrap.min.css"> --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="">
            <div class="row text-center mt-4">
                <div class="col-sm-9 mx-auto">
                    <h2>Data Produk Toko {{ $outlet->name_outlet }}</h2>
                    <p>Data ini dicetak pertanggal : {{ $today->format('d/m/Y') }}</p>
                </div>
            </div>
            <hr>
            <div class="">
                <div class="row">
                    <div class="col-sm-9 mx-auto">
                        <p><b>Total Produk : </b><mark>{{ $total }} produk</mark></p>
            
                        @if(isset($totalLowStock) && $totalLowStock > 0)
                            <p><b>Status Stok :</b> ada <mark><u>{{ $totalLowStock }} produk</u></mark> yang kurang dari minimal stok.</p>
                        @else
                            <p><b>Status Stok :</b> Semua produk masih tersedia, <u>Tidak ada</u> produk yang kurang dari minimal stok.</p>
                        @endif
                    </div>
                  <hr>
                    <div>
                        <div class="">
                            <div class="">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th width="15px">NO</th>
                                            <th width="80px">Kode</th>
                                            <th width="100px">Produk</th>
                                            <th width="50px">Unit</th>
                                            <th width="50px">Stok</th>
                                            <th width="50px">Min Stok</th>
                                            <th width="90px">Harga Beli</th>
                                            <th width="90px">Harga Jual</th>
                                            <th width="200px">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    @if($product->count() > 0)
                                    @foreach($product as $data_product)
                                    <tbody>
                                        <tr class="">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data_product->barcode }}</td>
                                            <td>{{ $data_product->name_product }}</td>
                                            <td>{{ $data_product->satuan_product }}</td>
                                            <td>{{ $data_product->stock }}</td>
                                            <td>{{ $data_product->minimal_stock }}</td>
                                            <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                                            <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                                            <td>{{ $data_product->desc }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10"><p class="text-center">Data produk kosong</p></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bootsrap -->
        {{-- <script src="../../../../public/js/bootstrap.bundle.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
