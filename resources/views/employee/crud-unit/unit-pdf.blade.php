<!DOCTYPE html>
<html>
    <head>
    <!-- bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>
    #dataproduk {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 50%;
    margin: 0 auto;
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
    margin-top: 30px;
    }

    /* Gaya tambahan untuk keterangan total */
    .keterangan p {
    margin-top: 20px;
    margin-right: 20px;
    text-align: left;
    }
    </style>
    </head>
    <body>
        <div class="container-xl">
            <div class="text-center">
                <h1>Data Satuan unit {{ $outlet->name_outlet }}</h1>
                <p><b>data ini dicetak pertanggal <u>{{ $today }}</u></b></p>
            </div>
            <hr>
            <div class="keterangan">
                <p><b>Keterangan :</b> Id pada satuan unit ini digunakan untuk mengisi import data produk pada file <b>excel</b></p>
            </div>
            <table id="dataproduk">
                    <tr>
                        <th class="column100 column1" width="20px" data-column="column1">No</th>
                        <th class="column100 column2" data-column="column2">Satuan</th>
                        <th class="column100 column1" width="100px" data-column="column1">Id</th>
                    </tr>
                    @if($unit->count() > 0)
                    @foreach($unit as $u)
                        <tr class="row100">
                            <td class="column100 column1" data-column="column1">{{ $loop->iteration }}</td>
                            <td class="column100 column2" data-column="column2">{{ $u->satuan }}</td>
                            <td class="column100 column1" data-column="column1">{{ $u->id }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="10"><p class="text-center">Data satuan unit kosong</p></td>
                        </tr>
                    @endif
            </table>
        </div>
    <!-- bootsrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7c21a511e6.js" crossorigin="anonymous"></script>
    </body>
</html>