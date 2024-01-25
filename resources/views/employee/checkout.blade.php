@extends('employee.layouts.main')
@section('content')
<style>
    .line2 {
        margin: 5px 0;
        height: 2px;
        background:
            repeating-linear-gradient(90deg, #445069 0 10px, #0000 0 12px)
    }
</style>
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
                        <div class="row"></div>
                        <div class="d-flex card-body mt-4">
                            <div class="col-md-8">
                                @if(session('success'))
                                <div id="hide" class="alert alert-success m-2" role="alert">
                                    <i class="fa-regular fa-circle-check mr-2"></i> {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div id="hide" class="alert alert-danger m-2" role="alert">
                                    <i class="fa-regular fa-circle-xmark mr-2"></i> {{ session('error') }}
                                </div>
                                @endif
                                @if(session('pay'))
                                <div class="alert alert-warning m-2" role="alert">
                                    <i class="fa-solid fa-circle-exclamation mr-2"></i><b>Note :</b> Tekan tombol selesai jika ingin keluar dari halaman ini!
                                </div>
                                @endif
                                @if(!session('pay'))
                                <div class="d-flex justify-content-center mb-2">
                                    <h2 class="card-title text-center"><b>Tambahan </b></h2>
                                </div>
                                @if(!Session::has('additional_cost'))
                                <form action="{{ route('addCost') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group d-flex mb-3 mx-1">
                                        <label for="additional_cost" class="col-md-3 col-form-label">Biaya Tambahan</label>
                                        <div class="d-flex col-md-9 gap-2">
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" id="additional_cost" name="additional_cost" value="{{ Session::get('additional_cost') }}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success text-white" title="Pilih"><i class="fa-solid fa-circle-plus mr-2"></i>Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="form-group d-flex mb-3 mx-1">
                                    <label for="additional_cost" class="col-md-3 col-form-label">Biaya Tambahan</label>
                                    <div class="d-flex col-md-9 gap-2">
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" id="additional_cost" name="additional_cost" value="{{ Session::get('additional_cost', 0) }}" readonly required>
                                        </div>
                                        @if(!session('pay'))
                                        <div class="col-md-3">
                                            <a href="{{ route('delete.addCost') }}" class="btn btn-danger"><i class="fa-solid fa-trash mr-2"></i>Hapus</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if(!session('notes'))
                                <form action="{{ route('notes') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group d-flex mb-3 mx-1">
                                        <label for="note" class="col-md-3 col-form-label">Catatan</label>
                                        <div class="d-flex col-md-9 gap-2">
                                            <div class="col-md-9">
                                                <textarea type="text" class="form-control" id="note" name="note" placeholder="Masukkan catatan, alamat, atau pesan pelanggan" required>{{ Session::get('notes') }}</textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success text-white" title="Pilih"><i class="fa-solid fa-circle-plus mr-2"></i>Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="form-group d-flex mb-3 mx-1">
                                    <label for="note" class="col-md-3 col-form-label">Catatan</label>
                                    <div class="d-flex col-md-9 gap-2">
                                        <div class="col-md-9">
                                            <textarea type="text" class="form-control" id="note" name="note" placeholder="Masukkan catatan, alamat, atau pesan pelanggan" readonly required>{{ Session::get('notes') }}</textarea>
                                        </div>
                                        @if(!session('pay'))
                                        <div class="col-md-3">
                                            <a href="{{ route('delete.notes') }}" class="btn btn-danger"><i class="fa-solid fa-trash mr-2"></i>Hapus</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <hr>
                                @endif
                                <div class="d-flex justify-content-center mb-2">
                                    <h2 class="card-title text-center"><b>Pembayaran</b></h2>
                                </div>
                                <div class="form-group d-flex mb-3 mx-1">
                                    <label for="total_price" class="col-md-3 col-form-label">Total</label>
                                    <div class="d-flex col-md-9 gap-2">
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" id="total_price" name="total_price" value="{{ Session::get('subtotal') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                @if(!session('pay'))
                                <form action="{{ route('pay.transaction') }}" method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return confirmPayment()">
                                    @csrf
                                    <div class="form-group d-flex mb-3 mx-1">
                                        <label for="bayar" class="col-md-3 col-form-label">Bayar</label>
                                        <div class="d-flex col-md-9 gap-2">
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" id="bayar" name="bayar" value="{{ Session::get('pay') }}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-money-bill mr-2"></i>Bayar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="form-group d-flex mb-3 mx-1">
                                    <label for="bayar" class="col-md-3 col-form-label">Bayar</label>
                                    <div class="d-flex col-md-9 gap-2">
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" id="bayar" name="bayar" value="{{ Session::get('pay', 0) }}" readonly required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(Session::get('change'))
                                <div class="form-group d-flex mb-3 mx-1">
                                    <label for="kembali" class="col-md-3 col-form-label">Kembali</label>
                                    <div class="d-flex col-md-9 gap-2">
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" id="kembali" name="kembali" value="{{ session('change') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                    @if(!Session::get('pay'))
                                    <a href="{{ route('cancel.transaction') }}" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin membatalkan transaksi pembelian ini?')"><i class="fa-solid fa-rectangle-xmark mr-2"></i></i></i>Batal Pembelian</a>
                                    <a href="{{ route('transaction') }}" class="btn btn-success"><i class="fa-solid fa-circle-plus mr-2"></i>Tambah Produk</a>
                                    @else
                                    <a href="{{ route('checkoutpdf') }}" class="btn btn-primary"><i class="fa-solid fa-print mr-2"></i>Cetak Nota</a>
                                    <a href="{{ route('finish.transaction') }}" class="btn btn-success"><i class="fa-solid fa-check-to-slot mr-2"></i>Selesai</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 shadow-lg p-4 bg-body-tertiary rounded">
                                <div class="row text-center mt-2">
                                    <h2 class="card-title"><b>{{ $outlet->name_outlet }}</b></h2>
                                    <span>{{ $outlet->address }}</span>
                                    <span>Telp: {{ $outlet->phone }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>No Ref : {{ $no_ref }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Kasir : {{ $emp->name_employee }}</span>
                                    @if(!session('today'))
                                    <span>{{ $today }}</span>
                                    @else
                                    <span>{{ session('today') }}</span>
                                    @endif
                                </div>
                                <div class="line2 my-2"></div>
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
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function confirmPayment() {
        var bayar = document.getElementById('bayar').value;
        var formattedBayar = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(bayar);
        return confirm('Apakah Anda yakin ingin membayar ' + formattedBayar + '?');
    }
</script>

@endsection