@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    @if (session('msg'))
        <div class="alert alert-primary" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div style="margin: 15px; display: grid; grid-template-columns: 1fr auto;">
        <div style="display: inline-block; margin: 15px; font-size: 25px;">
            Saldo Anda adalah : <h2>{{ App\Http\Controllers\ProductController::rupiah($buyer->balance) }}</h2>
        </div>
        <form action="{{ route('topUpSaldo') }}">
            <div>
                Top Up : 
                <input type="number" name="saldo" class="form-control" id="saldo" style="margin-bottom: 10px;">
                <button class="btn btn-success btn-m"><i class="fa fa-plus"></i> Top Up</button>
            </div>
            
        </form>
    </div>
 
</div>
@endsection