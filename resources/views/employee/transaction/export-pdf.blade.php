<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>HTML5 Starter Template</title>
        <meta name="description" content="Starter Template">
        <meta name="author" content="Gregry Pike">
        <link rel="stylesheet" href="css/styles.css?v=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .line2 {
                margin: 5px 0;
                height: 2px;
                background:
                    repeating-linear-gradient(90deg, #445069 0 10px, #0000 0 12px)
            }
        </style>
    </head>
    <body>
        <div class="col-md-3">
            <div class="row text-center mt-2">
                <h2 class="card-title"><b>{{ $data['outlet']['name_outlet'] }}</b></h2>
                <span>{{ $data['outlet']['address'] }}</span><br>
                <span>Telp: {{ $data['outlet']['phone'] }}</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>No Ref : {{ session('no_ref') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Kasir : {{ $data['emp']['name_employee'] }}</span>
                <span>{{ session('today') }}</span>
            </div>
            <div class="line2 my-2">----------------------------------------------------</div>
            @if(session('cart'))
            @foreach(session('cart') as $cartItem)
            <div class="row">
                <span><b>{{ $cartItem['name_product'] }}</b></span>
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <span>{{ $cartItem['qty'] }}</span>
                        <span class="mx-2">x</span>
                        <span>Rp {{ number_format($cartItem['selling_price']) }}</span>
                    </div>
                    @if($cartItem['discount'] > 0)
                    <span>(Rp {{ number_format($cartItem['selling_price_disc']) }})</span>
                    @endif
                    <span>Rp {{ number_format($cartItem['qty'] * $cartItem['selling_price_disc']) }}</span>
                </div>
            </div>
            @endforeach
            @endif
            @if(Session::get('additional_cost'))
            <div class="row mb-2 mt-2">
                <div class="d-flex justify-content-between">
                    <span><b>Biaya Tambahan </b></span>
                    <span>Rp {{ number_format(Session::get('additional_cost', 0)) }}</span>
                </div>
            </div>
            @endif
            <div class="line2 my-2"></div>
            <div class="row mb-2">
                <div class="d-flex justify-content-between">
                    <span><b>Total :</b></span>
                    <span id="total_price"><b>Rp {{ number_format(Session::get('subtotal')) }}</b></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Bayar :</span>
                    <span>Rp {{ number_format(Session::get('pay'))}}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Kembali :</span>
                    <span>Rp {{ number_format(Session::get('change'))}}</span>
                </div>
            </div>
            @if(Session::get('notes'))
            <p><b>Note :</b> {{ Session::get('notes') }}</p>
            @endif
            <div class="row text-center mt-4 mb-2">
                <span><b>Terima kasih</b></span>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
