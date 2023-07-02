@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Cart
    </div>
</div>

    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
        @if (session('cart'))
            @foreach (session('cart') as $id =>$details)
                <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-xl-2">
                        <img src="{{$details['image']}}" class="img-fluid rounded-3" alt="{{$details['name']}}">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-black mb-0">{{$details['name']}}</h6>
                        <h6 class="text-muted">{{App\Http\Controllers\ProductController::rupiah($details['price'])}}</h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2">
                        <input id="quantity{{ $details['idProduk'] }}" min="0" name="quantity" value="{{$details['quantity']}}" type="number" class="form-control form-control-sm" onchange="updateQuantity({{ $details['idProduk'] }})"/>
                        <h6 id="stock{{$details['idProduk']}}" style="color: {{ $details['stock'] < 5 ? 'red' : 'inherit' }}" value="{{ $details['stock']}}">Stock : {{ $details['stock'] }}</h6>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2">
                        <h6 class="mb-0">{{App\Http\Controllers\ProductController::rupiah($details['price'] * $details['quantity'])}}</h6>
                    </div>
                    <div class="col-xl-1 text-end">
                        <button onclick="removeProductCart({{ $details['idProduk'] }})" style="border: none;"><i class='bx bx-trash'></i></button>
                    </div>
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" onclick="doCheckout()">Checkout</button>
        @else
            <div class="alert alert-primary" role="alert">
                <strong>No products in cart</strong>
            </div>


        @endif

    </div>

@endsection

@section('script')
<script>
    function removeProductCart(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('removeProductCart')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                window.location.reload(true);
            }
        });
    }

    function updateQuantity(id) {
        var quantity = $("#quantity"+id).val();
        $.ajax({
            type: 'POST',
            url: "{{ route('updateQuantity')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'quantity': quantity
            },
            success: function (data) {
                window.location.reload(true);
            }
        });
    }

    function doCheckout(){
        let session = JSON.parse('<?php echo json_encode(session('cart')) ?>');
        if (session){
            var status = "success";

            for(let i=0;i<session.length;i++){
                alert($("#quantity" + session('cart')[i]["idProduk"]).val() + $("#stock" + session('cart')[i]["idProduk"]).val());
                if($("#quantity" + session('cart')[i]["idProduk"]).val()>$("#stock" + session('cart')[i]["idProduk"]).val()){
                    alert('Jumlah melebihi stok');
                    status = "gagal";
                    break;
                }

            }
            if(status == "success"){
                alert("Thank you for your purchase!");
            }
        }


    }
</script>
@endsection
