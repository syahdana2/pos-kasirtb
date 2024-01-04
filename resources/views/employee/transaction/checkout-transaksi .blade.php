@extends('employee.layouts.main')

@section('content')
    <div class="wrapper w-[100%] h-[85vh]  mt-5 bg-[#F1F1F1] rounded-lg border shadow-2xl p-3 relative">

        <div class="text-center border-b-2 border-emerald-500 p-3 w-full ">
            <h2 class="text-3xl font-light capitalize">Pembelian Produk</h2>    
        </div>

        <div class="flex gap-5 px-5 h-[85%] justify-evenly relative mt-3">
            <div class="list-checkout-wrapper border border-slate-400 shadow-md rounded-md w-[50%] h-full relative">
                <div class="btn-group flex gap-3 bg-slate-300 rounded-md p-3 absolute top-0 left-0 z-10 w-full">
                    <a href="{{ route('cancel_transaction') }}"
                        onclick="return confirm('apakah yakin ingin membatalkan transaksi?')"
                        class="px-3 py-1 bg-red-500 text-white rounded-md border-2 border-slate-300 text-sm flex items-center"><i
                            class="fa fa-angle-double-left mr-2"></i> Batal</a>
                    <a href="{{ route('transaction_page') }}"
                        class="px-3 py-1 bg-green-500 text-white rounded-md border-2 border-slate-300 text-sm flex items-center"><i
                            class="fa fa-plus mr-2"></i> Tambah</a>
                </div>
                <form action="{{ route('submit_checkout_product') }}" method="POST">
                    <div class="list-item p-3 rounded-lg overflow-auto no-scrollbar h-full pt-14 relative -z-0 divide-y-2 divide-slate-400">
                        @foreach ($selling_unit as $product)
                            <div class="item flex justify-between p-3 border-slate-600 mb-3">
                                <div>
                                    <h3 class="font-medium text-xl">{{ $product->product_name }} <span class="text-xs italic">( {{ $product->barcode }} )</span></h3>
                                    <select class="text-sm" name="sel_unit_{{ $product->id }}">
                                        @foreach ($product->selling_units as $selling_units)
                                            <option value="{{ $selling_units->id }}">
                                                {{ $selling_units->unit->name }}<i class="fa fa-chevron-down ml-2"></i>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex gap-5 justify-center items-center">
                                    <div class="btn-group flex justify-center items-center gap-2">
                                        <div
                                            class="flex justify-center items-center px-2 py-1 rounded-md bg-slate-300 border border-slate-400 w-fit h-fit">
                                            <span id="decrement-button" onclick="decrement(event.target.id)"
                                                class=" w-[18px] h-[18px] border border-black rounded-full flex justify-center items-center text-sm"><i id="{{ $product->id }}"
                                                    class="fa fa-minus"></i></span>
                                        </div>
                                        <input name="qty_{{ $product->id }}" id="{{ 'qty-input-' . $product->id }}"
                                            class=" text-center rounded-md border text-black border-slate-400 w-10 h-fit flex justify-center items-center"
                                            type="number" value="1">
                                        <div
                                            class="flex justify-center items-center px-2 py-1 rounded-md bg-slate-300 border border-slate-400 w-fit h-fit">
                                            <span id="increment-button" onclick="inc(event.target.id)"
                                                class=" w-[18px] h-[18px] border border-black rounded-full flex justify-center items-center text-sm"><i id="{{ $product->id }}"
                                                    class="fa fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>

            <div class="member-form p-5 w-[45%] h-fit border border-black shadow-md rounded-lg">

                @csrf

                <div class="flex flex-col gap-3 mb-5">
                    <div>
                        <span class="text-red-500 font-medium text-sm">
                            @if ( $message = Session::get('error'))
                            {{ $message }}
                            @else
                            * Khusus untuk member
                            @endif</span>
                    </div>
                    <div class="input-group flex w-full justify-between items-center">
                        <label class="text-md font-semibold" for="kode" class="w-[30%]">Kode Member</label>
                        <input type="text" name="kode" id="kode"
                            class="w-[70%] h-[35px] border rounded-md border-black p-3">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                        class=" focus:outline-none text-white bg-sky-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-3 py-2 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <i class="bi bi-send mr-3"></i> Submit</button>
                    </div>
                </div>
                
                </form>
            </div>

        </div>


    </div>
@endsection


@section('content-js')
    <script>
        function inc(id) {
            var include_value = $('#qty-input-' + id).val();
                var value = Number(include_value);
                value = isNaN(value) ? 0 : value;
                value++
                $('#qty-input-' + id).val(value);
        }

        function decrement(id) {
            console.log(id)
            var include_value = $('#qty-input-' + id).val();
                var value = Number(include_value);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $('#qty-input-' + id).val(value);
                }
        }
        $(document).ready(function() {
            $('#increment-button').click(function(e) {
                // e.preventDefault();

                var include_value = $('#qty-input').val();
                var value = Number(include_value);
                value = isNaN(value) ? 0 : value;
                value++
                $('#qty-input').val(value);
            });



            $('#decrement-button').click(function(e) {
                e.preventDefault();

                var include_value = $('#qty-input').val();
                var value = Number(include_value);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $('#qty-input').val(value);
                }
            });
        })
    </script>
@endsection
