@extends('admin.layouts.app')
@section('title' , 'Detail Transaksi')
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
                <div class="col-md-5">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center p-4">
                            <a href="javascript:window.history.back();" type="submit" class="btn btn-warning"><i class="fa-solid fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                        <div class="d-flex card-body">
                            <div class="col-md-12 shadow-lg p-4 bg-body-tertiary rounded">
                                <div class="row text-center mt-2">
                                    <h2 class="card-title"><b>{{ $transactionData->employee->outlet->name_outlet }}</b></h2>
                                    <span>{{ $transactionData->employee->outlet->address }}</span>
                                    <span>Telp: {{ $transactionData->employee->outlet->phone }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>No Ref : {{ $transactionData->kode_invoice }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Kasir : {{ $transactionData->employee->name_employee }}</span>
                                    <span>{{ $transactionData->created_at }}</span>
                                </div>
                                <div class="line2 my-2"></div>
                                @foreach($detailTransactionData as $detail)
                                <div class="row">
                                    @if($detail->product)
                                    <span><b>{{ $detail->product->name_product }}</b></span>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <span>{{ $detail->qty }}</span>
                                            <span class="mx-2">x</span>
                                            <span>Rp {{ number_format($detail->product->selling_price) }}</span>
                                        </div>
                                        @if($detail->discount)
                                        <span>(Rp {{ number_format($detail->price_sales) }})</span>
                                        @endif
                                        <span>Rp {{ number_format($detail->total_price) }}</span>
                                    </div>
                                    @else
                                    <span><b>Ada produk yang dihapus</b></span>
                                    @endif
                                </div>
                                @endforeach
                                @if($transactionData->additional_cost)
                                <div class="row mb-2 mt-2">
                                    <div class="d-flex justify-content-between">
                                        <span><b>Biaya Tambahan </b></span>
                                        <span>Rp {{ number_format($transactionData->additional_cost) }}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="line2 my-2"></div>
                                <div class="row mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span><b>Total :</b></span>
                                        <span id="total_price"><b>Rp {{ number_format($transactionData->subtotal) }}</b></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Bayar :</span>
                                        <span>Rp {{ number_format($transactionData->pay)}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Kembali :</span>
                                        <span>Rp {{ number_format($transactionData->change)}}</span>
                                    </div>
                                </div>
                                @if($transactionData->note)
                                <p><b>Note :</b> {{ $transactionData->note }}</p>
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