@extends('layouts.sneat')
@section('content')
<section>
    {{-- @php
        dd($totalIncomeByMonth)
    @endphp --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Grafik Penjualan</div>
                    <div class="card-body">
                        <div id="grafik"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    var data = {!! json_encode($totalIncomeByMonth) !!};
    var bulan = data.map(item => item.month);
    var pendapatan = data.map(item => item.total_income);

    Highcharts.chart('grafik', {
        title:{
            text: 'Grafik Pendapatan Bulanan'
        },
        xAxis:{
            categories: bulan
        },
        'yAxis':{
            title:{
                text: 'Nominal Pendapatan Bulanan'
            }
        },
        plotOptions:{
            series:{
                allowPointSelect: true
            }
        },
        series:[{
            name: 'Nominal Pendapatan',
            data: pendapatan
        }]
    });
</script>
@endsection
