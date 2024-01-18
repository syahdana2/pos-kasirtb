@extends('employee.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Detail Pembelian</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="d-flex card-body mt-4">
                            <div class="col-md-8">
                                @if(session('success'))
                                <div class="alert alert-success m-2" role="alert">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger m-2" role="alert">
                                    {{ session('error') }}
                                </div>
                                @endif
                                @if(Session::get('additional_cost') || Session::get('notes'))
                                    <div class="d-flex justify-content-center mb-2">
                                        <h2 class="card-title text-center"><b>Tambahan </b></h2>
                                    </div>
                                    <div class="form-group row mb-3 mx-1">
                                        <label for="additional_cost" class="col-md-4 col-form-label">Biaya Tambahan</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" id="additional_cost" name="additional_cost" value="{{ Session::get('additional_cost', 0) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mx-1">
                                        <label for="note" class="col-md-4 col-form-label">Catatan</label>
                                        <div class="col-md-8">
                                            <textarea type="text" class="form-control" id="note" name="note" readonly>{{ Session::get('notes') }}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                <div class="d-flex justify-content-center mb-2">
                                    <h2 class="card-title text-center"><b>Pembayaran</b></h2>
                                </div>
                                <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group row mb-3 mx-1">
                                        <label for="total" class="col-md-4 col-form-label">Total</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" id="total" name="total" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mx-1">
                                        <label for="bayar" class="col-md-4 col-form-label">Bayar</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" id="bayar" name="bayar" value="0" onchange="totalPrice(this.value)" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 mx-1">
                                        <label for="kembali" class="col-md-4 col-form-label">Kembali</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" id="kembali" name="kembali" value="0" required readonly>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mr-3 mt-2">
                                        <a href="javascript:window. history. back();" type="submit" class="btn btn-warning"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
                                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-money-bill mr-2"></i>Bayar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 shadow-lg p-4 bg-body-tertiary rounded">
                                <div class="row text-center mt-2">
                                    <h2 class="card-title"><b>{{ $outlet->name_outlet }}</b></h2>
                                    <span>{{ $outlet->address }}</span>
                                    <span>Telp: {{ $outlet->phone }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>Kasir : {{ $emp->name_employee }}</span>
                                    <span>18/01/2024</span>
                                </div>
                                <p class="text-center">-------------------------------------------------------</p>
                                @php
                                    $totalCart = 0;
                                @endphp
                                
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
                                                <span>(Rp. {{ number_format($cartItem['selling_price_disc']) }})</span>
                                            @endif
                                            <span>Rp {{ number_format($cartItem['qty'] * $cartItem['selling_price_disc']) }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $totalCart += $cartItem['qty'] * $cartItem['selling_price_disc'];
                                    @endphp
                                @endforeach
                                @if(session::get('notes'))
                                <div class="row my-1">
                                    <div class="d-flex justify-content-between">
                                        <span>Biaya Tambahan :</span>
                                        <span>Rp {{ number_format(Session::get('additional_cost', 0)) }}</span>
                                    </div>
                                </div>
                                @endif
                                <p class="text-center">-------------------------------------------------------</p>
                                <div class="row mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span><b>Total :</b></span>
                                        <span id="total_price"><b>Rp {{ number_format($totalCart, 2) }}</b></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Bayar :</span>
                                        <span id="spanBayar">Rp 0</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Kembali :</span>
                                        <span id="spanKembali">Rp 0</span>
                                    </div>
                                </div>
                                @if(session::get('notes'))
                                <p>Note : {{ Session::get('notes') }}</p>
                                @endif
                                <div class="row text-center mt-4 mb-2">
                                    <span><b>Terima kasih</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

<script>
    function totalPrice(val) {
        var input_bayar = val;
        var total_price = Number($('#total_price').html()); // Replace this with the actual total amount

        // Update form input
        document.getElementById('kembali').value = total_price - input_bayar;

        // Update span elements
        document.getElementById('spanBayar').innerText = 'Rp ' + input_bayar;
        document.getElementById('spanKembali').innerText = 'Rp ' + (total_price - input_bayar);
    }
</script>
<script>
    // Assuming $totalCart is available in the PHP section
    var totalCartValue = Number($('#total_price').html());

    // Set the total_cart value in the "Total" input
    document.getElementById('total').value = totalCartValue;
</script>