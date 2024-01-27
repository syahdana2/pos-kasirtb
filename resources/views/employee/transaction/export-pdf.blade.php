<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <meta name="description" content="Starter Template">
        <meta name="author" content="Gregry Pike">
        <link rel="stylesheet" href="css/styles.css?v=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col-md-6">
                <div class="col-9">
                    <div class="row-justify-content-center">
                        <div class="row text-center">
                            <h5 class="card-title"><b>{{ $outlet->name_outlet }}</b></h5>
                            <div class="d-flex justify-content-center">
                                <p><b>{{ $outlet->address }}</b></p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <p>Telp: {{ $outlet->phone }}</p>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-start">
                                <h6>No Ref : {{ session('no_ref') }}</h6>
                            </div>
                                    <div class="row justify-content-betweeen">
                                        <table>
                                            <td>
                                                <h6>Kasir : {{ $emp->name_employee }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $today }}</h6>
                                            </td>
                                        </table>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <p><b>---------------------------------------------------</b></p>
                    </div>  
                </div>
              @if(session('cart'))
              @foreach(session('cart') as $cartItem)
                <div class="row">
                    <div class="row">
                        <h6><b>{{ $cartItem['name_product'] }}</b></h6>
                    </div>
                        <div class="row col-12 justify-content-between">
                            <div class="row">
                                <table>
                                    <td>
                                        <p><b>{{ $cartItem['qty'] }}</b></p>
                                    </td>
                                    <td>
                                        <p><b>x</b></p>
                                    </td>
                                    <td>
                                        <p>{{ number_format($cartItem['selling_price']) }}</p>
                                    </td>
                                    <td>
                                        @if($cartItem['discount'] > 0)
                                            <p>({{ number_format($cartItem['selling_price_disc']) }})</p>
                                        @else
                                        <td>
                                            <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></p>
                                        </td>    
                                        @endif
                                    </td>
                                    <td>
                                        <p>Rp {{ number_format($cartItem['qty'] * $cartItem['selling_price_disc']) }}</p>
                                    </td>
                                </table>
                            </div>
                        </div>
                </div>
              @endforeach
              @endif
              @if(Session::get('additional_cost'))
                <div class="row col-12 justify-content-between">
                    <div class="row">
                        <hr>
                        <table>
                            <td>
                                <h6><b>Biaya Tambahan : </b></h6>
                            </td>
                            <td>
                                <h6>Rp {{ number_format(Session::get('additional_cost', 0)) }}</h6>
                            </td>
                        </table>
                    </div>
                </div>
              @endif
                <div class="row">
                    <div class="row">
                        <p><b>---------------------------------------------------</b></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-9">
                        <div class="row">
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    <div id="total_price"><b>&nbsp;&nbsp;&nbsp;&nbsp;Total  : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp {{ number_format(Session::get('subtotal')) }}</div>
                                </div>
                                {{-- <div class="col-auto">
                                    <span id="total_price"><b>Rp {{ number_format(Session::get('subtotal')) }}</b></span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    <div><b>&nbsp;&nbsp;&nbsp;&nbsp;Bayar : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp {{ number_format(Session::get('pay'))}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row justify-content-center">
                                <div class="col-5">
                                    <div><b>&nbsp;&nbsp;&nbsp;&nbsp;kembali :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp {{ number_format(Session::get('change'))}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="row justify-content-center">
                        <div class="row text-center mt-4 mb-2">
                                <h6><b>*** Terima kasih ***</b></h6>
                                <hr>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
