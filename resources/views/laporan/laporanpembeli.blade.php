@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Laporan Pembeli dengan Poin Terbanyak
    </div>
</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<div style="display: flex; justify-content: space-between;">
    <select class="form-select" aria-label="Default select example" name="urutkan" id="urutkan" style="width: 150px; margin-bottom: 10px;" onchange="reloadPage()">
        <option value="-">Urutkan</option>
        <option value="PL" {{ (request()->segment(5) == "PL") ? 'selected' : '' }}>Paling Banyak</option>
        <option value="KL" {{ (request()->segment(5) == "KL") ? 'selected' : '' }}>Paling Sedikit</option>        
</select>
</div>

<section>
    <div class="table-responsive" >
        <table id="tabelLaporanProduk" class="table table-striped" style="width:100%">
            <thead class="table-border-bottom-0">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jumlah Poin</th>
                </tr>
            </thead>
            <tbody>
                @if (count($laporanPembeliResults) == 0)
                <tr>
                    <td class="text-center" colspan="8">Tidak ada pembeli yang memiliki poin</td>
                </tr>
                @else
                @foreach ($laporanPembeliResults as $laporanPembeli)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <th>{{$laporanPembeli->name}}</th>
                    <th>{{$laporanPembeli->email}}</th>
                    <th>{{$laporanPembeli->point}}</th>
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
        var urutan = $("#urutkan").val();
        if(urutan == '-'){
            window.location.href = '/laporan/pembeli/';
        }else{
            window.location.href = '/laporan/pembeli/' + urutan ;
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

