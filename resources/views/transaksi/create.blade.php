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
        </form>
        
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total : </th>
                <th id="total"></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Pajak : </th>
                <th  id="pajak"></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Grand Total : </th>
                <th id="grandTotal"></th>
            </tr>
        </table>

        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Simpan</button>
        <a href="/transaksi"class="btn btn-danger">Batal</a>
      </div>

@endsection

@section('script')
<script type="text/javascript">
    var today = new Date();
    var formattedDate = today.toISOString().substr(0, 10);
    $("#tanggalTransaksi").val(formattedDate);


    var arrayProduk = [];
    var count = 1;

    $("#btnTambah").click(function () {
        var products = <?php echo json_encode($products); ?>;
        var product = products.find(item => item.id == $("#namaProduk").val());
        var jumlah = $("#jumlah").val();

        var produk = {
            id: $("#namaProduk").val(),
            jumlah: jumlah,
            harga:product.price,
            total:jumlah*product.price
        };
        arrayProduk.push(produk);

        $("#bodyTabel").append('<tr id="barang' + product.id +'"><td>'+ count +'</td><td>'+product.product_name+'</td><td>'+product.price+'</td><td>'+ jumlah+'</td>'+
            '<td>'+ parseFloat(jumlah*product.price) +'</td><td><button type="button" class="btn btn-danger" onclick="hapusBarangKeranjang('+product.id+')">X</button></td></tr>');

        $("#total").text(getTotalBelanja());
        $("#pajak").text(getPajak());
        $("#grandTotal").text(getGrandTotal());


        count++;
    }); 

    function getTotalBelanja(){
        var totalBelanja = 0;
        for (let i = 0; i < arrayProduk.length; i++) {
            totalBelanja += arrayProduk[i].harga;
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
        $("#total").text(getTotalBelanja());
    }
</script>
@endsection
