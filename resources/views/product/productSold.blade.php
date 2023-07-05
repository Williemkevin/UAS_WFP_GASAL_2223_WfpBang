@extends('layouts.sneat')

@section('content')
<section>
    <div class="container px-2 px-lg-2   mt-2">
            <div class="card">
                <div class="demo-inline-spacing">
                <div class="row">
                    <div class="col-xl-12">
                    <div class="nav-align-top mb-4">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                
                                <div style="display: flex; justify-content: space-between;">
                                <div>
                                        <label for="bulanan" style="float: left; margin-top: 7px; margin-right: 7px;">Bulanan:</label>
                                        <select class="form-select" aria-label="Default select example" name="bulan" id="bulan" style="width: 150px; margin-bottom: 10px; float: left;" onchange="reloadPage()">
                                        <?php
                                            $selected = false;
                                            for ($year = 2023; $year <= date('Y'); $year++) {
                                                $endMonth = ($year == date('Y')) ? date('m') : 12;
                                                for ($month = 1; $month <= $endMonth; $month++) {
                                                    $optionValue = sprintf('%02d-%04d', $month, $year);
                                        
                                                    if (($month == request()->segment(3) && $year == request()->segment(4)) || ($month == date('m') && !$selected)) {
                                                        echo "<option value=\"$optionValue\" selected>" . date('F Y', strtotime("$year-$month-01")). "</option>";
                                                        $selected = true;
                                                    } else {
                                                        echo "<option value=\"$optionValue\">" . date('F Y', strtotime("$year-$month-01")). "</option>";
                                                    }
                                        
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div> 
                                @if ($productSold->count() == 0)
                                    <h5 class="card-header" id="inactive-staff-text">Tidak Ada Produk Terjual</h5>
                                @else

                                </div>
                                
                                <h5 class="card-header">Daftar Produk Terjual</h5>
                                @if (session('success'))
                                    <div class="alert alert-primary" id="flash-message" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="tableProductSold">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal Transaksi</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($productSold as $eachProduct)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $eachProduct->product_name }}</strong></td>
                                                    
                                                    <td>
                                                        @php
                                                            $categoryNames = explode(',', $eachProduct->category_names);
                                                        @endphp
                                                        @foreach ($categoryNames as $categoryName)
                                                            {{ $categoryName }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $eachProduct->price }}
                                                    </td>
                                                    <td>
                                                        {{ $eachProduct->quantity }}
                                                    </td>
                                                    <td>
                                                        {{ $eachProduct->transaction_date }}
                                                    </td>
                                                </tr>
                                            <div>
                                        </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
            {{-- <div id="myElement">Hello, jQuery!</div> --}}
    </div> 
</section>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#tableProductSold').DataTable({
            "scrollX": true
        });
    });
    function reloadPage(idTransaksi) {
        var bulanSelected = $("#bulan").val().split('-');
        var urutan = $("#urutkan").val();
        if(urutan == '-'){
            window.location.href = '/admin/productsold/' + bulanSelected[0] + '/' + bulanSelected[1] ;
        }else{
            window.location.href = '/admin/productsold/' + bulanSelected[0] + '/' + bulanSelected[1] + '/' + urutan ;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
