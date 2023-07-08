
<div class="container">
    <div class="d-flex">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="card-title mb-0" style="margin-right: 60px;">Date : {{ \Carbon\Carbon::parse($productsTransactions[0]->transaction_date)->format('d F Y') }}
            </h5>
            </div>
            </div>
        </div>
    </div>

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
    @foreach ($productsTransactions as $detailTransaksi)
    <tr>
        <th>{{ $loop->iteration}}</th>
        <th>{{ $detailTransaksi->product_name }}</th>
        <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksi->price)}}</th>
        <th>{{ $detailTransaksi->quantity }}</th>
        <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksi->total)}}</th>
    </tr>
    @endforeach
    <tr>
        <th></th><th></th><th></th>
        <th>Sub Total : </th>
        <th>{{App\Http\Controllers\ProductController::rupiah($productsTransactions[0]->total)}}</th>
    </tr>
    <tr>
        <th></th><th></th><th></th>
        <th>Redeem Point : </th>
        <th>-{{App\Http\Controllers\ProductController::rupiah(($productsTransactions[0]->redeem_point * 10000))}}</th>
    </tr>
    <tr>
        <th></th><th></th><th></th>
        <th>Pajak : </th>
        <th>{{App\Http\Controllers\ProductController::rupiah($productsTransactions[0]->tax)}}</th>
    </tr>
    <tr>
        <th></th><th></th><th></th>
        <th>Grand Total : </th>
        <th>{{App\Http\Controllers\ProductController::rupiah($productsTransactions[0]->grand_total)}}</th>
    </tr>
</table>
</div>