@extends('layouts.sneat')

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Detail Transaksi
    </div>
    <div style="float: right; margin-top: 7px; margin-right: 7px;">
      <form action="{{url('print/nota')}}">
          <input type="hidden" value="{{$detailTransaksis[0]->transaction_id}}" name="idTransaksi" id="idTransaksi">
          <button class="btn btn-info btn-sm"><i class="bx bx-printer"></i>Cetak</button>
      </form>
  </div>
</div> 
      <div class="container">
            <div class="d-flex">
                <div class="card" style="width: 30rem;">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h5 class="card-title mb-0" style="margin-right: 60px;">Date : {{ \Carbon\Carbon::parse($detailTransaksis[0]->transaction_date)->format('d F Y') }}
                    </h5>
                    </div>
                  </div>
                </div>
            </div>
        
        <table class="table">
          <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
          </thead>
          @foreach ($detailTransaksis as $detailTransaksi)
          <tr>
              <th>{{ $loop->iteration}}</th>
              <th>{{ $detailTransaksi->product_name }}</th>
              <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksi->price)}}</th>
              <th>{{ $detailTransaksi->quantity }}</th>
              <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksi->quantity*$detailTransaksi->price)}}</th>
          </tr>
          @endforeach
            <tr>
              <th></th><th></th><th></th>
              <th>Sub Total : </th>

              @php
              $subTotal = 0;
              foreach ($detailTransaksis as $detailTransaksi){
                $subTotal += $detailTransaksi->quantity * $detailTransaksi->price;
              }
              @endphp
              <th>{{App\Http\Controllers\ProductController::rupiah($subTotal)}}</th>
            </tr>
            <tr>
              <th></th><th></th><th></th>
              <th>Redeem Point : </th>
              <th>-{{App\Http\Controllers\ProductController::rupiah(($detailTransaksis[0]->redeem_point * 10000))}}</th>
            </tr>
            <tr>
              <th></th><th></th><th></th>
              <th>Pajak : </th>
              <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksis[0]->tax)}}</th>
            </tr>
            <tr>
              <th></th><th></th><th></th>
              <th>Grand Total : </th>
              <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksis[0]->grand_total)}}</th>
            </tr>
        </table>
    </form>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#tabelTransaksi').DataTable({
            "scrollX": true
        });
    });
    $("#bulan").on('change', function() {
        var bulanSelected = $("#bulan").val().split('-');
        window.location.href = '/transaksi/' + bulanSelected[0] + '/' + bulanSelected[1];
    });
</script>
@endsection