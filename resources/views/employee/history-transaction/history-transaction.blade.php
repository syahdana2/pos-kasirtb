@extends('employee.layouts.main')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $title }} Hari Ini</h1>
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
                    <form action="{{ route('history.searchByDate') }}" method="post">
                      @csrf
                      <div class="d-flex justify-content-start col-md-12">
                        <div class="form-group row mr-2">
                          <label for="start_date" class="col-sm-4 col-form-label">Tanggal :</label>
                          <div class="col-sm-8">
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="end_date" class="col-sm-4 col-form-label">Sampai :</label>
                          <div class="d-flex col-sm-8 gap-2">
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                            <button type="submit" class="btn btn-primary" title="Cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                      <thead>
                        <tr class="bg-navy">
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" width="120px">Tanggal</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="170px">Kode Invoice</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Kasir</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="50px">Subtotal</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Bayar</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Kembali</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="85px">Laba</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="20px">Aksi</th>
                        </tr>
                      </thead>
                      @php
                      $totalSubtotal = 0;
                      $totalProfit = 0;
                      @endphp
                      <tbody>
                        @if($transactions->count() > 0)
                        @foreach($transactions as $dt_transaction)
                        <tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">{{ $loop->iteration }}</td>
                          <td>{{ date('d/m/Y h:i', strtotime($dt_transaction->created_at)) }}</td>
                          <td>{{ $dt_transaction->kode_invoice }}</td>
                          <td>{{ $dt_transaction->employee_name }}</td>
                          <td>Rp {{ number_format($dt_transaction->subtotal) }}</td>
                          <td>Rp {{ number_format($dt_transaction->pay) }}</td>
                          <td>Rp {{ number_format($dt_transaction->change) }}</td>
                          <td>Rp {{ number_format($dt_transaction->labaProfit) }}</td>
                          <td>
                            <div class="d-flex gap-1">
                              <a href="{{ route('history.show', $dt_transaction->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></a>
                              <form action="{{ route('transaction.destroy', $dt_transaction->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus transaksi dengan kode {{ $dt_transaction->kode_invoice }} pada tanggal {{ $dt_transaction->created_at }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Hapus">
                                  <i class="fa-solid fa-trash"></i>
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>
                        @php
                        $totalSubtotal += $dt_transaction->subtotal;
                        $totalProfit += $dt_transaction->labaProfit;
                        @endphp
                        @endforeach
                        <tr>
                          <td class="bg-warning"></td>
                          <td class="bg-warning"></td>
                          <td class="bg-warning"></td>
                          <td class="bg-warning"></td>
                          <td class="bg-warning"><b>Rp {{ number_format($totalSubtotal) }}</b></td>
                          <td class="bg-success"></td>
                          <td class="bg-success"></td>
                          <td class="bg-success"><b>Rp {{ number_format($totalProfit) }} </b></td>
                          <td class="bg-success"></td>
                        </tr>
                        @else
                        <tr>
                          <td class="text-center" colspan="8">Data transaksi kosong</td>
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
</section>


@endsection