@extends('employee.layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <!-- /.card-body -->
            <div class="card-body">
              @if(session('success'))
              <div id=".hide" class="alert alert-success" role="alert">
                <i class="fa-regular fa-circle-check mr-2"></i> {{ session('success') }}
              </div>
              @endif
              @if(session('error'))
              <div id=".hide" class="alert alert-danger" role="alert">
                <i class="fa-regular fa-circle-xmark mr-2"></i> {{ session('error') }}
              </div>
              @endif
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                        <tr class="bg-navy">
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="60px">Tanggal</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="170px">Kode Invoice</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Kasir</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Subtotal</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Bayar</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="90px">Kembali</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($transaction->count() > 0)
                        @foreach($transaction as $dt_transaction)
                        <tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">{{ $loop->iteration }}</td>
                          <td>{{ $dt_transaction->created_at->format('d/m/Y') }}</td>
                          <td>{{ $dt_transaction->kode_invoice }}</td>
                          <td>{{ $dt_transaction->employee->name_employee }}</td>
                          <td>Rp {{ number_format($dt_transaction->subtotal) }}</td>
                          <td>Rp {{ number_format($dt_transaction->pay) }}</td>
                          <td>Rp {{ number_format($dt_transaction->change) }}</td>
                          <td>
                            <div class="d-flex gap-1">
                              <a href="{{ route('history.show', $dt_transaction->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye mr-2"></i>Detail</a>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td class="text-center" colspan="10">Data transaksi kosong</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
      </div>
    </div>
  </div>
</div>

@endsection