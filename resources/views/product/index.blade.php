@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Product
    </div>
    <div style="float: right; margin: 15px;">
        <a href="{{url('product/create')}}" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Add Produk</a>
    </div>
</div>

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<section>
    <div class="container px-2 px-lg-2 mt-2">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($productAktif as $product)
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
                            <button onclick="nonaktifkan({{ $product->id }})" class="btn btn-sm btn-danger"><i class='bx bx-power-off'></i></button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
</script>
@endsection

