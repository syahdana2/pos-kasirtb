<!DOCTYPE html>
<html>
    <head>
    
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
        <div class="">
            <center>
                <h1>Data Produk Toko Bangunan</h1>
                <span id="tanggalContainer"></span>
            </center>
        </div>
        <hr>
        <div class="keterangan">
            <p>Total Produk: 2</p>
            <p>Total Harga Jual: Rp 170.000</p>
            <p>Total Harga Beli: Rp 140.000</p>
            <p>Status Stok: Semua produk masih tersedia.</p>
        </div>
        <hr>
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
        </table>
        <script>
            // Mendapatkan tanggal hari ini
            var today = new Date();
        
            // Mengisi nilai ke elemen dengan ID 'tanggalContainer'
            document.getElementById('tanggalContainer').innerHTML = 'Laporan Data produk ini dicetak per tanggal : ' + formatDate(today);
        
            // Fungsi untuk memformat tanggal ke dalam bentuk "DD/MM/YYYY"
            function formatDate(date) {
                var day = date.getDate();
                var month = date.getMonth() + 1; // January is 0!
                var year = date.getFullYear();
        
                // Menambahkan "0" di depan hari atau bulan jika kurang dari 10
                day = day < 10 ? '0' + day : day;
                month = month < 10 ? '0' + month : month;
        
                return day + '/' + month + '/' + year;
            }
        </script>
    </body>
</html>
