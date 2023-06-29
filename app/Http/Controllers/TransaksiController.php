<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Product;
use App\Models\ProductsHasTransactions;
use App\Models\Staff;
use App\Models\Transactions;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bulan = null, $tahun = null)
    {
        $idBuyer = Buyer::select('buyers.id')
            ->join('users', 'users.id', '=', 'buyers.user_id')
            ->where('users.id', Auth::id())
            ->first();
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
            ->whereRaw("YEAR(transactions.transaction_date) = $tahun");
        if (Auth::user()->role == 'buyer') {
            $transaksis->where('B.user_id', Auth::user()->id);
        }
        $transaksis = $transaksis->get();
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $staffs = DB::table('staffs AS s')->join('users AS u', 's.user_id', '=', 'u.id')->select('s.id', 'u.name')->get();
        $buyers = DB::table('buyers AS b')->join('users AS u', 'b.user_id', '=', 'u.id')->select('b.id', 'u.name')->get();


        return view('transaksi.create', compact('products', 'staffs', 'buyers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transactions = new Transactions();
        $transactions->transaction_date = $request->get('tanggalTransaksi');
        $transactions->total = $request->get('total');
        $transactions->tax = $request->get('tax');
        $transactions->grand_total = $request->get('grandtotal');
        $transactions->get_point = $request->get('grandtotal') / 100;
        // $transactions->redeem_point = $request->get('grandtotal');
        $transactions->buyer_id = $request->get('namaCustomer');
        $transactions->staff_id = $request->get('namaStaff');

        $transactions->save();

        $arrayProduk = json_decode($request->get('arrayProduk'), true);
        if (empty($arrayProduk)) {
            return Redirect::back();
        } else {
            foreach ($arrayProduk as $ap) {
                if ($ap != '-') {
                    $productTransaction = new ProductsHasTransactions();
                    $productTransaction->product_id = $ap['id'];
                    $productTransaction->quantity = $ap['jumlah'];
                    $productTransaction->price = $ap['harga'];
                    $productTransaction->transaction_id = $transactions->id;

                    $productTransaction->created_at = now("Asia/Bangkok");
                    $productTransaction->updated_at = now("Asia/Bangkok");
                    $productTransaction->save();
                }
            }
        }
        return $this->create();
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
