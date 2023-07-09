<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Buyer::join('users as u', 'u.id', '=', 'buyers.user_id')
            ->select('buyers.*', 'u.*')->where('buyers.membership', '1')->get();
        $nonmembers = Buyer::join('users as u', 'u.id', '=', 'buyers.user_id')
            ->select('buyers.*', 'u.*')->where('buyers.membership', '0')->get();
        return view('buyer.index', compact('members', 'nonmembers'));
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

    public function getmember()
    {
        //
        //Display all category & soft deleted
        $nonMembers =
            DB::table('users')
            ->join('buyers', 'users.id', '=', 'buyers.user_id')
            ->select('users.*', 'buyers.*')
            ->where('buyers.membership', '=', '0')
            ->get();

        $members =
            DB::table('users')
            ->join('buyers', 'users.id', '=', 'buyers.user_id')
            ->select('users.*', 'buyers.*')
            ->where('buyers.membership', '=', '1')
            ->get();

        return view(
            'owner.list-membership',
            [
                'nonMembers' => $nonMembers,
                'members' => $members
            ]
        );
    }

    public function updatemembership(Request $request)
    {
        // Retrieve the memberId and command from the request
        $memberId = $request->input('memberId');
        $command = $request->input('command');

        if ($command == 'REMOVE-MEMBER') {

            DB::table('buyers')
                ->where('id', $memberId)
                ->update(['membership' => '0']);
        } else {
            DB::table('buyers')
                ->where('id', $memberId)
                ->update(['membership' => '1']);
        }
    }

    public function showSaldo()
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        return view('saldo.index', compact('buyer'));
    }

    public function topUpSaldo(Request $request)
    {
        $buyerTopUp = Buyer::where('user_id', Auth::user()->id)->first();
        $buyerTopUp->balance = $buyerTopUp->balance + $request->saldo;
        $buyerTopUp->save();

        $buyer = Buyer::where('user_id', Auth::user()->id)->first();

        return view('saldo.index', compact('buyer'))->with('msg', 'Top Up Saldo Berhasil');
    }

    public static function showPoint()
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        return $buyer->point;
    }
}
