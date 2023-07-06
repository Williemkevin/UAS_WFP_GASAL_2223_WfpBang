@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Product
    </div>

    @if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))
    <div style="float: right; margin: 15px;">
        <a href="{{url('product/create')}}" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Add Produk</a>
    </div>
    @endif
</div>

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<section>
    <div style="margin: 15px; font-size: 15px; font-weight: bold;">
        Filter : 
        <select class="form-select" aria-label="Default select example" name="filterKategori" id="filterKategori">
            <option value="all">-- Filter Category --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{$kategori->category_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="container px-2 px-lg-2 mt-2">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($productAktif as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="{{'images/'. $product->image_url}}" alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                            {{ App\Http\Controllers\ProductController::rupiah($product->price)}}
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center" style="width: 110%;">
                            @if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                                <button onclick="nonaktifkan({{ $product->id }})" class="btn btn-sm btn-danger"><i class='bx bx-power-off'></i></button>
                            @endif

                            @if(str_contains(Auth::user()->role, 'buyer'))
                                <button onclick="addCart({{ $product->id }})" style="border: none;"><i class='bx bx-cart'></i></button>
                                @if (in_array($product->id, $productWishlist))
                                    <button onclick="removeWishlist({{ $product->id }})" style="border: none;"><i class='bx bxs-heart' style="color: black;"></i></button>
                                @else
                                    <button onclick="addWishlist({{ $product->id }})" style="border: none;"><i class='bx bx-heart' style="color: black;"></i></button>
                                @endif
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
                                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />

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
    <div class="pagination-container d-flex justify-content-end">
        {{ $productAktif->links('pagination::bootstrap-4') }}
    </div>
</section>

<section>
@if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Product Non Aktif
    </div>
</div>
<div class="container px-2 px-lg-2   mt-2">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($productNonAktif as $product)
        <div class="col mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                        {{ App\Http\Controllers\ProductController::rupiah($product->price)}}
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                        <button onclick="aktifkan({{ $product->id }})" class="btn btn-sm btn-success"><i class='bx bx-power-off'></i></button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="pagination-container d-flex justify-content-end">
    {{ $productNonAktif->links('pagination::bootstrap-4') }}
</div>
@endif
</section>
@endsection

@section('script')
<script>
    function nonaktifkan(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.nonaktifkan') }}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

    function aktifkan(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.aktifkan')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

    function addWishlist(id) {
        $.ajax({
            type: 'GET',
            url: "{{ route('product.addWishlist')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

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
                if (data['status'] == 'success') {
                    alert('Horrey Product telah ditambah');
                }
            }
        });
    }

    $("#filterKategori").on("change", function() {
        var idCategori = $("#filterKategori").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('product.index')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'filterKategori': idCategori,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    alert('Horrey Product telah ditambah');
                }
            }
        });
    });
</script>
@endsection

