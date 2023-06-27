<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bulan = null, $tahun = null)
    {
        if ($bulan == null && $tahun == null) {
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;
        }
        $transaksis = Transactions::join('products_has_transactions as THP', 'transactions.ID', '=', 'THP.transaction_id')
            ->join('products as P', 'THP.product_id', '=', 'P.ID')
            ->join('buyers as B', 'transactions.buyer_id', '=', 'B.ID')
            ->join('users as U', 'B.user_id', '=', 'U.ID')
            ->select('transactions.*', 'THP.product_id', 'THP.price', 'THP.quantity', 'P.product_name', 'U.name')
            ->whereRaw("MONTH(transactions.transaction_date) = $bulan")
            ->whereRaw("YEAR(transactions.transaction_date) = $tahun")->get();
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
