<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\ProductsHasTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class laporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function laporanproduk($bulan = null, $tahun = null, $filter = null)
    {
        if ($bulan == null && $tahun == null) {
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;
        }
        $laporanProduk = ProductsHasTransactions::selectRaw('SUM(quantity) as total_quantity, products.id , products.product_name, MONTHNAME(transaction_date) AS bulan')
            ->join('products', 'products.id', '=', 'products_has_transactions.product_id')
            ->join('transactions', 'transactions.id', '=', 'products_has_transactions.transaction_id')
            ->groupBy('products.id', 'product_name', 'transaction_date')
            ->whereMonth('transactions.transaction_date', '=', $bulan)
            ->whereYear('transactions.transaction_date', '=', $tahun);
        if ($filter == 'PL') {
            $laporanProduk->orderBy('total_quantity', 'DESC');
        } else if ($filter == 'KL') {
            $laporanProduk->orderBy('total_quantity', 'ASC');
        }
        $laporanProdukResults = $laporanProduk->get();
        return view('laporan.laporanproduk', compact('laporanProdukResults'));
    }

    public function laporanpembeli($filter = null)
    {
        $laporanPembeli =
        DB::table('users')
            ->join('buyers', 'users.id', '=', 'buyers.user_id')
            ->select('users.*', 'buyers.*')
            ->where('buyers.membership', '=', '1');
        
        if ($filter == 'PL') {
            $laporanPembeli->orderBy('point', 'DESC');
        } else if ($filter == 'KL') {
            $laporanPembeli->orderBy('point', 'ASC');
        }
        $laporanPembeliResults = $laporanPembeli->get();
        return view('laporan.laporanpembeli', compact('laporanPembeliResults'));
    }

}
