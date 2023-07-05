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
<form method="POST" action="{{route('product.update', $produk->id)}}" enctype="multipart/form-data">
    @method("PUT")
    @csrf
    <div class="form-group">
        <label for="exampleInputEmaill">Nama product :</label>
        <input type="text" name="namaProduct" class="form-control" id="namaProduct" aria-describedby="nameHelp" value={{$produk->product_name}}>

        <div class="mb-3">
            <label for="exampleInputEmaill">Image Url : </label>
            <input class="form-control" type="file" id="image" name="image" value={{$produk->image_url}}>
        </div>

        <label for="exampleInputEmaill">Price : </label>
        <input type="number" name="priceProduct" class="form-control" id="priceProduct" aria-describedby="nameHelp" value={{$produk->price}}>

        <label for="exampleInputEmaill">Stock : </label>
        <input type="number" name="stock" class="form-control" id="stock" aria-describedby="nameHelp" value={{$produk->stock}}>

        <label for="exampleInputEmaill">Dimension : </label>
        <input type="text" name="dimesion" class="form-control" id="dimesion" aria-describedby="nameHelp" value={{$produk->dimension}}>
        <label for="exampleInputEmaill">Type : </label>
        <div>
            <select class="form-select" aria-label="Default select example" name="type" id="type">
                <option>-- Pilih Type --</option>
                @foreach ($types as $type)
                @if($type->id == $produk->type_id)
                    <option value="{{ $type->id }}" selected>{{$type->type_name}}</option>
                @else
                    <option value="{{ $type->id }}">{{$type->type_name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <label for="exampleInputEmaill">Kategori : </label>
        <div id="kategori">
            @php
                $count = 1;
            @endphp
            @foreach ($productCategories as $pc)
                <div class=' + count + '>
                    <select style="width:90%; float:left; margin-bottom:10px; margin-right:10px;" class="form-select kategori{{ $count }}" aria-label="Default select example" name="kategori[]" id="kategori">
                        @foreach ($categories as $categori)
                            @if ($categori->id == $pc->category_id)
                                <option value="{{ $categori->id }}" selected>{{$categori ->category_name }}</option> 
                            @else
                                <option value="{{ $categori->id }}">{{$categori ->category_name }}</option> 
                            @endif
                        @endforeach 
                    </select>
                    <button style="width:5%; margin-top:5px;" type="submit" class="btn btn-danger" onclick="deletekategori({{ $count }})">X</button>
                </div> 
                @php
                    $count++;
                @endphp
            @endforeach
        </div>
        <input type="button" id="btnAddKategori" value="Tambah Kategori" style="width: 100%;" class="btn btn-primary">            
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection

@section('script')
<script type="text/javascript">
var count = <?php echo $count; ?>;
$("#btnAddKategori").click(function () {
    count++;
    $("#kategori").append(
        '<div class=' + count + '><div><select style="width:90%; float:left; margin-bottom:10px; margin-right:10px;" class="form-select kategori' + count +'" aria-label="Default select example" name="kategori[]" id="kategori">' +
        '<option value="-">-- Pilih Categories --</option>@foreach ($categories as $categori)<option value="{{ $categori->id }}">{{$categori ->category_name }}</option>' +
        '@endforeach </select>' +
        '<button style="width:5%; margin-top:5px;" type="submit" class="btn btn-danger" onclick="deletekategori(' + count +')">X</button></div>');        
});
function deletekategori(id) {
        $("." + id).remove();
}
</script>
@endsection
