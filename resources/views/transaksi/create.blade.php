<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
</style>
@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Add New Transaksi
    </div>
</div>
      <div class="container">
        <form method="POST" action="{{route('transaksi.store')}}">
            @csrf
            <div class="d-flex">
                <div class="card" style="width: 30rem;">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h5 class="card-title mb-0" style="margin-right: 60px;">Date</h5>
                      <input type="date" name="tanggalTransaksi" class="form-control ml-2" id="tanggalTransaksi" aria-describedby="nameHelp">
                    </div>
                    <div class="d-flex align-items-center" style="margin-top: 20px;">
                      <h5 class="card-title mb-0" style="margin-right: 60px;">Staff</h5>
                      <select class="form-select" aria-label="Default select example" name="namaStaff" id="namaStaff">
                        <option>-- Pilih Staff --</option>
                        @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}">{{$staff->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="d-flex align-items-center" style="margin-top: 20px;">
                      <h5 class="card-title mb-0" style="margin-right: 20px;">Customer</h5>
                      <select class="form-select" aria-label="Default select example" name="namaCustomer" id="namaCustomer">
                        <option>-- Pilih Customer --</option>
                        @foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id }}">{{$buyer->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="card" style="width: 30rem; margin-left: 15%;" >
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <h5 class="card-title mb-0" style="margin-right: 60px;">Produk</h5>
                      <select class="form-select" aria-label="Default select example" name="namaProduk" id="namaProduk">
                        <option>-- Pilih Produk --</option>
                        @foreach ($products as $produk)
                            <option value="{{ $produk->id }}">{{$produk->product_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="d-flex align-items-center" style="margin-top: 20px;">
                      <h5 class="card-title mb-0" style="margin-right: 60px;">Jumlah</h5>
                      <input type="number" name="jumlah" class="form-control ml-2" id="jumlah" aria-describedby="nameHelp" value="1" min="1">
                    </div>
                    <button type="button" class="btn btn-primary" style="float: right; margin-top: 20px;" id="btnTambah">
                        <i class="menu-icon tf-icons bx bx-cart"></i>
                        Tambah
                    </button>
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
                <th>Action</th>
            </tr>
          </thead>
          <tbody id="bodyTabel">

          </tbody>
            <tr>
              <th></th><th></th><th></th><th></th>
              <th>Sub Total : </th>
              <th id="subtotal"></th>
            </tr>
            <tr>
              <th></th><th></th><th></th><th></th>
              <th>Pajak : </th>
              <th  id="pajak"></th>
            </tr>
            <tr>
              <th></th><th></th><th></th><th></th>
              <th>Grand Total : </th>
              <th id="grandTotal"></th>
            </tr>
        </table>

        <button type="submit" class="btn btn-success" style="margin-top: 20px;" id="simpan">Simpan</button>
        <a href="/transaksi"class="btn btn-danger" style="margin-top: 20px;">Batal</a>
      </div>
      <input type="hidden" name="arrayProduk" id="arrayProdukInput">
      <input type="hidden" name="total" id="total">
      <input type="hidden" name="tax" id="tax">
      <input type="hidden" name="grandtotal" id="grandtotal">
    </form>

@endsection

@section('script')
<script type="text/javascript">
    var today = new Date();
    var formattedDate = today.toISOString().substr(0, 10);
    $("#tanggalTransaksi").val(formattedDate);

    var arrayProduk = [];

    var session = JSON.parse('<?php echo json_encode(session("cart")) ?>');
    $.each(session, function (key, value) {
        arrayProduk.push(value);
    });

    $("#btnTambah").click(function () {
        var products = <?php echo json_encode($products); ?>;
        var product = products.find(item => item.id == $("#namaProduk").val());
        var jumlah = parseInt($("#jumlah").val());

        var checkProduct = arrayProduk.find(item => item.id == product.id);
        if(checkProduct){
          checkProduct.jumlah += jumlah;
          checkProduct.total = checkProduct.jumlah * checkProduct.harga;
        }else{
          var produk = {
            id: $("#namaProduk").val(),
            name: product.product_name,
            quantity: jumlah,
            price:product.price,
            total:jumlah*product.price
          };
          arrayProduk.push(produk);
        }
        refreshTabel();
    });

    function refreshTabel(){
      var count = 1;
      var subtotal = 0;
      $("#bodyTabel").empty();
    //   for (var i = 0; i < arrayProduk.length; i++) {
    //       $("#bodyTabel").append('<tr id="barang' + arrayProduk[i].id +'"><td>'+ count +'</td><td>'+ arrayProduk[i].namaProduk+'</td><td>'+ arrayProduk[i].harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) +'</td><td>'+ arrayProduk[i].jumlah+'</td>'+
    //           '<td>'+ parseFloat(arrayProduk[i].jumlah * arrayProduk[i].harga).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) +'</td><td><button type="button" class="btn btn-danger" onclick="hapusBarangKeranjang('+ arrayProduk[i].id +')">X</button></td></tr>');
    //       count++;
    //   }
      $.each(arrayProduk, function (key, value) {
        $("#bodyTabel").append('<tr id="barang' + value["id"] +'"><td>'+ count +'</td><td>'+ value["name"]+'</td><td>'+ value["price"].toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) +'</td><td>'+ value["quantity"]+'</td>'+
              '<td>'+ parseFloat(value["quantity"] * value["price"]).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) +'</td><td><button type="button" class="btn btn-danger" onclick="hapusBarangKeranjang('+ value["id"] +')">X</button></td></tr>');
          count++;
          subtotal+= parseFloat(value["quantity"] * value["price"]);
      });
      var pajak = subtotal*0.11;
      var grand_total = subtotal + pajak;
    //   $("#subtotal").text(getTotalBelanja().toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
    //   $("#pajak").text(getPajak().toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
    //   $("#grandTotal").text(getGrandTotal().toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
      $("#subtotal").text(subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
      $("#pajak").text(pajak.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
      $("#grandTotal").text(grand_total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));
    }


    function getTotalBelanja(){
        var totalBelanja = 0;
        for (let i = 0; i < arrayProduk.length; i++) {
            totalBelanja += arrayProduk[i].harga*arrayProduk[i].jumlah;
        }
        return totalBelanja;
    }
    function getPajak(){
        pajak = getTotalBelanja()*0.11;
        return pajak;
    }
    function getGrandTotal(){
        grandTotal =getTotalBelanja() + getPajak();
        return grandTotal;
    }

    function hapusBarangKeranjang(id){
        arrayProduk = arrayProduk.filter(item => item.id != id);
        $("#barang" + id).remove();
        refreshTabel();
    }
    refreshTabel();

    $("#simpan").click(function () {
      $("#arrayProdukInput").val(JSON.stringify(arrayProduk));
      $("#total").val(getTotalBelanja());
      $("#tax").val(getPajak());
      $("#grandtotal").val(getGrandTotal());
    });

</script>
@endsection
