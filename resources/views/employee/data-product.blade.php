@extends('employee.layouts.main')

@section('head')
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboardemployee">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <!-- /.card-body -->
              <div class="card-body">
                @if(isset($totalLowStock) && $totalLowStock > 0)
                                <div class="alert alert-warning mt-2" role="alert">
                                    Ada <a href="#" class="alert-link">{{ $totalLowStock }} produk</a> memiliki stok kurang dari 5 atau perlu restock.
                                </div>
                            @endif
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                <a href="{{ route('product') }}" 
                  class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-info shadow-md text-light"><i 
                  class="fa-solid fa-arrows-rotate mr-2 "></i> refresh</a>
               {{-- <a href="{{ route('member_page') }}" --}}
               <a href="{{ route('product.create') }}" 
                  class=" btn border border-white rounded-lg px-3 py-2 flex justify-center items-center text-sm bg-success shadow-md text-light"><i
                  class="fa-solid fa-plus mr-2"></i> Tambah</a>
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      
                      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr class="bg-navy">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" width="20px">No</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Produk</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" width="150px">Barcode</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Unit</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Stok</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Harga Beli</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Harga Jual</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="80px">Dibuat</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" width="100px">aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($product->count() > 0)
                    @foreach($product as $data_product)
                      <tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">{{ $loop->iteration }}</td>
                          <td>{{ $data_product->barcode }}</td>
                          <td>{{ $data_product->name_product }}</td>
                          <td>{{ $data_product->satuan_product }}</td>
                          <td>{{ $data_product->stock }}</td>
                          <td>Rp. {{ number_format($data_product->selling_price) }}</td>
                          <td>Rp. {{ number_format($data_product->buy_price) }}</td>
                          <td>{{ $data_product->employee_name }}</td>
                          <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('product.show', $data_product->id) }}" class="btn btn-primary text-white" title="Detail"><i class="fa-solid fa-eye"></i></i></a>
                                <a href="{{ route('product.edit', $data_product->id) }}" class="btn btn-warning text-white" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('product.destroy', $data_product->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin menghapus data ini')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    @else
                      <tr>
                        <td class="text-center" colspan="10">Data produk kosong</td>
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

@endsection

@section('script')
  <!-- DataTables  & Plugins -->
  <script src="{{asset('AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{asset('AdminLTE')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  {{-- table search --}}
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": []
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection