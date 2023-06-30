@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Transaksi
    </div>
    <div style="float: right; margin: 15px;">
        <a href="{{url('transaksi/create')}}" class="btn btn-success btn-m"><i class="fa fa-plus"></i> Add Transaksi</a>
    </div>
</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div>
    <label for="bulanan" style="float: left; margin-top: 7px; margin-right: 7px;">Bulanan:</label>
    <select class="form-select" aria-label="Default select example" name="bulan" id="bulan" style="width: 150px; margin-bottom: 10px;">
    <?php
    $selected = false;
    for ($year = 2023; $year <= date('Y'); $year++) {
        $endMonth = ($year == date('Y')) ? date('m') : 12;
        for ($month = 1; $month <= $endMonth; $month++) {
            $optionValue = sprintf('%02d-%04d', $month, $year);

            if (($month == request()->segment(2) && $year == request()->segment(3)) || ($month == date('m') && !$selected)) {
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

<section>
    <div class="table-responsive" >
        <table id="transaksi" class="table table-striped" style="width:100%">
            <thead class="table-border-bottom-0">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Point</th>
                    <th>Total</th>
                    <th>Pajak</th>
                    <th>Grand Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($transaksis) == 0)
                <tr>
                    <td class="text-center" colspan="8">Tidak ada transaksi yang terdata</td>
                </tr>
                @else
                @foreach ($transaksis as $transaksi)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <th>{{ \Carbon\Carbon::parse($transaksi->transaction_date)->format('d F Y') }}</th>
                    <th>{{$transaksi->name}}</th>
                    <th>{{$transaksi->get_point}}</th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($transaksi->total)}}</th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($transaksi->tax)}}</th>
                    <th>{{App\Http\Controllers\ProductController::rupiah($transaksi->grand_total)}}</th>
                    <td class="text-center"><button onclick="detailTransaksi({{ $transaksi->id}})" class="btn btn-sm btn-primary"><i class='bx bx-detail'></i></button>
                    </td>
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
        $('#transaksi').DataTable();
    });
    $("#bulan").on('change', function() {
        var bulanSelected = $("#bulan").val().split('-');
        window.location.href = '/transaksi/' + bulanSelected[0] + '/' + bulanSelected[1] ;
    });
    function detailTransaksi(idTransaksi) {
        window.location.href = '/transaksi/detail/' + idTransaksi ;
    }
</script>
@endsection

