<!DOCTYPE html>
<html>
    <head>
    <!-- bootsrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    </head>
    <body>
        <div class="container-lg">
            <hr>
            <div class="row text-center mx-auto mt-4">
                <div class="col-sm-12 mx-auto">
                    <h2>Data Satuan unit {{ $outlet->name_outlet }}</h2>
                    <p>Data ini dicetak pertanggal <b>{{ $today }}</b></p>
                </div>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-sm-9 mx-auto">
                        <hr>
                        <p><b>Ket :</b> Sesuaikan <b>Id unit</b> ini dengan import data produk pada <u>file excel</u></p>
                        <hr>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-sm-6 mx-auto">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="row" width="20px">No</th>
                                    <th scope="row">Satuan</th>
                                    <th scope="row">Id</th>
                                </tr>
                            </thead>
                            @if($unit->count() > 0)
                            @foreach($unit as $u)
                            <tbody>
                                <tr class="">
                                    <td class="column100 column1" data-column="column1">{{ $loop->iteration }}</td>
                                    <td class="column100 column2" data-column="column2">{{ $u->satuan }}</td>
                                    <td class="column100 column1" data-column="column1">{{ $u->id }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="10"><p class="text-center">Data satuan unit kosong</p></td>
                                </tr>
                            @endif
                    </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- bootsrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>