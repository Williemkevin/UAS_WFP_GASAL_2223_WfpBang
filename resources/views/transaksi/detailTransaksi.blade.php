@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Transaksi
    </div>
    <div style="float: right; margin: 15px;">
        <a href="{{url('transaksi/create')}}" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Add Transaksi</a>
    </div>
</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Transaksi
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
        
        <h2>Keranjang Belanja</h2>
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
              <th>{{ $detailTransaksi->price }}</th>
              <th>{{ $detailTransaksi->quantity }}</th>
              <th>{{ $detailTransaksi->total }}</th>
          </tr>
          @endforeach
            <tr>
              <th></th><th></th><th></th>
              <th>Sub Total : </th>
              <th>{{ $detailTransaksis[0]->total }}</th>
            </tr>
            <tr>
              <th></th><th></th><th></th>
              <th>Pajak : </th>
              <th>{{ $detailTransaksis[0]->tax }}</th>
            </tr>
            <tr>
              <th></th><th></th><th></th>
              <th>Grand Total : </th>
              <th>{{ $detailTransaksis[0]->grand_total }}</th>
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