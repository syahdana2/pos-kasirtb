<!DOCTYPE html>
<html>
    <head>
    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>
    #dataproduk {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 2px solid #39433f; /* Tambahkan border 3 pada tabel */
    border-radius: 12px;
    }

    #dataproduk td, #dataproduk th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #dataproduk tr:nth-child(even){background-color: #f2f2f2;}

    #dataproduk tr:hover {background-color: #ddd;}

    #dataproduk th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #39433f;
    color: white;
    }

    /* Gaya tambahan untuk judul dan paragraf */
    h1, p {
    text-align: center;
    }

    /* Gaya tambahan untuk keterangan total */
    .keterangan p {
    margin-top: 20px;
    text-align: left;
    }
    </style>
    </head>
    <body>
        <div class="text-center">
            <h1>Data Produk Toko {{ $outlet->name_outlet }}</h1>
            <p>Data ini dicetak pertanggal : {{ $today->format('d/m/Y') }}</p>
        </div>
        <hr>
        <div class="keterangan">
            <p>Total Produk: {{ $total }}</p>
            <p>Status Stok: Semua produk masih tersedia, tidak ada produk yang memiliki produk minim.</p>
        </div>
        <table id="dataproduk">
                <tr>
                    <th class="column100 column1" data-column="column1">NO</th>
                    <th class="column100 column2" data-column="column2">Kode</th>
                    <th class="column100 column3" data-column="column3">Produk</th>
                    <th class="column100 column4" data-column="column4">Unit</th>
                    <th class="column100 column5" data-column="column5">Stok</th>
                    <th class="column100 column6" data-column="column6">Harga Beli</th>
                    <th class="column100 column7" data-column="column7">Harga Jual</th>
                </tr>
                @if($product->count() > 0)
                @foreach($product as $data_product)
                    <tr class="row100">
                        <td class="column100 column1" data-column="column1">{{ $loop->iteration }}</td>
                        <td class="column100 column2" data-column="column2">{{ $data_product->barcode }}</td>
                        <td class="column100 column3" data-column="column3">{{ $data_product->name_product }}</td>
                        <td class="column100 column4" data-column="column4">{{ $data_product->satuan_product }}</td>
                        <td class="column100 column5" data-column="column5">{{ $data_product->stock }}</td>
                        <td class="column100 column6" data-column="column6">Rp. {{ number_format($data_product->buy_price) }}</td>
                        <td class="column100 column7" data-column="column7">Rp. {{ number_format($data_product->selling_price) }}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="10"><p class="text-center">Data produk kosong</p></td>
                    </tr>
                @endif
        </table>
    <!-- bootsrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
