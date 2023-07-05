@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Laporan Produk yang Sering Dibeli
    </div>
</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
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

    <select class="form-select" aria-label="Default select example" name="urutkan" id="urutkan" style="width: 150px; margin-bottom: 10px;" onchange="reloadPage()">
        <option value="-">Urutkan</option>
        <option value="PL" {{ (request()->segment(5) == "PL") ? 'selected' : '' }}>Paling Laku</option>
        <option value="KL" {{ (request()->segment(5) == "KL") ? 'selected' : '' }}>Kurang Laku</option>        
    </select>
</div>

<section>
    <div class="table-responsive" >
        <table id="tabelLaporanProduk" class="table table-striped" style="width:100%">
            <thead class="table-border-bottom-0">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Nama Produk</th>
                    <th>Jumlah terjual</th>
                </tr>
            </thead>
            <tbody>
                @if (count($laporanProdukResults) == 0)
                <tr>
                    <td class="text-center" colspan="8">Tidak ada produk yang terjual</td>
                </tr>
                @else
                @foreach ($laporanProdukResults as $laporanProduk)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <th>{{$laporanProduk->bulan}}</th>
                    <th>{{$laporanProduk->product_name}}</th>
                    <th>{{$laporanProduk->total_quantity}}</th>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        $('#tabelLaporanProduk').DataTable({
            "scrollX": true
        });
    });
    function reloadPage(idTransaksi) {
        var bulanSelected = $("#bulan").val().split('-');
        var urutan = $("#urutkan").val();
        if(urutan == '-'){
            window.location.href = '/laporan/produk/' + bulanSelected[0] + '/' + bulanSelected[1] ;
        }else{
            window.location.href = '/laporan/produk/' + bulanSelected[0] + '/' + bulanSelected[1] + '/' + urutan ;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

