<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .container {
        width: 900px;
        margin: 0 auto;
        padding: 15px;
    }

    .header {
        text-align: center;
    }
    span{
        display: block;
        margin-bottom: 7px;
    }

</style>
<body>
    <div class="container">
        <div class="header">
            <p style="font-weight: bold;">FASHION BRAND</p>
        </div>
        <div style="width: 30rem;">
            <div>
                <span>Pembeli : {{$transactions->name }}</span>
                <span>Tanggal : {{ \Carbon\Carbon::parse($transactions->transaction_date)->format('d F Y') }}</span>
                <span>Phone : {{$transactions->phone}}</span>
                <span>Alamat : {{$transactions->address}}</span>
            </div>
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($productsTransactions as $detailTransaksi)
                <tr>
                    <th>{{ $loop->iteration}}</th>
                    {{-- <th><img class="card-img-top" src="images/1688553865_1.jpg" alt="..."/></th> --}}
                    <th>{{ $detailTransaksi->product_name }}</th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksi->price)}}</th>
                    <th>{{ $detailTransaksi->quantity }}</th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($detailTransaksi->price * $detailTransaksi->quantity)}}</th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th><th></th><th></th><th></th>
                    <th>Sub Total : </th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($transactions->total)}}</th>
                </tr>
                <tr>
                    <th></th><th></th><th></th><th></th>
                    <th>Redeem Point : </th>
                    <th>-{{App\Http\Controllers\ProductController::rupiah(($transactions->redeem_point * 10000))}}</th>
                </tr>
                <tr>
                    <th></th><th></th><th></th><th></th>
                    <th>Pajak : </th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($transactions->tax)}}</th>
                </tr>
                <tr>
                    <th></th><th></th><th></th><th></th>
                    <th>Grand Total : </th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($transactions->grand_total)}}</th>
                </tr>
            </tfoot>
          </table>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
