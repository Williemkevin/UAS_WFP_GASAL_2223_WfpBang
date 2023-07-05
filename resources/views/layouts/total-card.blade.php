@auth
    @if (Auth::user()->role == 'owner' || Auth::user()->role == 'staff')
        <div class="container px-2 px-lg-2   mt-2">
            <div class="row">
                <div class="col">
                    <div class="card bg-primary text-white mb-3">
                        <a href="/" style="display: block;">
                            <div class="btn btn-primary" style="width: 100%;">Total Pendapatan</div>
                        </a>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                            <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                            </svg>
                            {{ App\Http\Controllers\ProductController::rupiah($totalIncomes)}}
                        </h5>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary text-white mb-3">
                        <a href="/" style="display: block;">
                            <div class="btn btn-primary" style="width: 100%;">Total Transaksi</div>
                        </a>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                            {{ $totalTransactions }}
                        </h5>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary text-white mb-3">
                        <a href="{{ route('admin.product.productsold') }}" style="display: block;">
                            <div class="btn btn-primary" style="width: 100%;">Total Produk Terjual</div>
                        </a>
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2" viewBox="0 0 16 16">
                        <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3L2.95.4ZM7.5 1H3.75L1.5 4h6V1Zm1 0v3h6l-2.25-3H8.5ZM15 5H1v10h14V5Z"/>
                        </svg>
                            {{ $totalProductsSold }}
                        </h5>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary text-white mb-3">
                        <a href="{{ route('admin.staff.index') }}" style="display: block;">
                            <div class="btn btn-primary" style="width: 100%;">Total Staff</div>
                        </a>
                        <div class="card-body" style="text-align: center">
                            <h5 class="card-title text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                            </svg>
                                {{ $totalStaff }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary text-white mb-3">
                        <a href="{{ route('admin.member.memberlist') }}" style="display: block;">
                            <div class="btn btn-primary" style="width: 100%;">Total Buyer</div>
                        </a>
                        <div class="card-body" style="text-align: center">
                            <h5 class="card-title text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                            </svg>
                                {{ $totalBuyer }}
                            </h5>
                        </div>
                    </div>
                </div>
            {{-- <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            </div> --}}
        </div>
    @endif
@endauth
