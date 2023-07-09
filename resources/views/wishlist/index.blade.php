@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Wishlist Product
    </div>
</div>

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<section>
    <div class="container px-2 px-lg-2 mt-2">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('images/'.$product->image_url) }}" alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                            {{ App\Http\Controllers\ProductController::rupiah($product->price)}}
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center" style="width: 110%;">

                            @if(str_contains(Auth::user()->role, 'buyer'))
                                <button onclick="addCart({{ $product->id }})" style="border: none;"><i class='bx bx-cart'></i></button>
                                <button onclick="removeWishlist({{ $product->id }})" style="border: none;"><i class='bx bxs-heart' style="color: black;"></i></button>
                                <a class="btn btn-sm btn-success" data-bs-toggle="modal" href="#showdetail_{{$product->id}}"><i class='bx bx-detail'>Detail</i></a>
                                <div class="modal fade" id="showdetail_{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="text-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card h-80">
                                                <img class="card-img-top" src="{{ asset('images/'.$product->image_url) }}" alt="..." />

                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                                        Price : {{ App\Http\Controllers\ProductController::rupiah($product->price)}}<br>
                                                        Stok tersedia : {{$product->stock}} {{$product->dimension}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>
@endsection

@section('script')
<script>
    function removeWishlist(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.removeWishlist')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                    alert('Horrey Product telah dihapus dari wishlist');
                }
            }
        });
    }

    function addCart(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('addToCart')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                alert('Horrey Product telah ditambah ke cart');
            }
        });
    }
</script>
@endsection


