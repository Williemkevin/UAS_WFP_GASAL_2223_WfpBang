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
        Add New Product
    </div>
</div>
<form method="POST" action="{{route('product.store')}}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmaill">Nama product :</label>
        <input type="text" name="namaDokter" class="form-control" id="namaProduct" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Image Url : </label>
        <input type="text" name="emailDokter" class="form-control" id="imageProduct" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Price : </label>
        <input type="text" name="usernameDokter" class="form-control" id="priceProduct" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Stock : </label>
        <input type="password" name="password" class="form-control" id="stock" aria-describedby="nameHelp">

        <label for="exampleInputEmaill">Dimension : </label>
        <input type="text" name="singkatan" class="form-control" id="dimesion" aria-describedby="nameHelp">
        <label for="exampleInputEmaill">Type : </label>
        <div>
            <select class="form-select" aria-label="Default select example" name="type" id="type">
                <option>-- Pilih Type --</option>
                @foreach ($types as $type)
                <option value="{{ $type->id }}">{{$type->type_name}}</option>
                @endforeach
            </select>
        </div>
        <label for="exampleInputEmaill">Kategori : </label>
        <div id="kategori"></div>
        <input type="button" id="btnAddKategori" value="Tambah Kategori" style="width: 100%;" class="btn btn-primary">
        <div>
            
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection

@section('script')
<script type="text/javascript">
var count = 0;

$("#btnAddKategori").click(function () {
    count++;
    $("#kategori").append(
        '<div id="kategori" class=' + count + '><div><select style="width:90%; float:left; margin-bottom:10px; margin-right:10px;" class="form-select kategori' + count +'" aria-label="Default select example" name="kategori[]" id="kategori">' +
        '<option value="-">-- Pilih Categories --</option>@foreach ($categories as $categori)<option value="{{ $categori->id }}">{{$categori ->category_name }}</option>' +
        '@endforeach </select>' +
        '<button style="width:5%; margin-top:5px;" type="submit" class="btn btn-danger" onclick="deletekategori(' + count +')">X</button></div>');        
});
function deletekategori(id) {
        $("." + id).remove();
}
</script>
@endsection
