<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_staffs = DB::table('users')
            ->join('staffs', 'users.id', '=', 'staffs.user_id')
            ->select('users.*', 'staffs.*')
            ->whereNull('staffs.deleted_at')
            ->get();

        $softDeletedStaffs = Staff::onlyTrashed()
        ->with(['user' => function ($query) {
            $query->withTrashed();}])
        ->get();

        return view('staff.index', [
            'user_staffs' => $user_staffs,
            'deleted_staffs' =>$softDeletedStaffs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Display add new staff form
        return view('staff.create');

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
        // $validatedData = $request->validate([
        //     'name' => 'required|max:45',
        //     'username' => 'required|max:255',
        //     'email' => 'required|email',
        //     'password' => 
        // ]);
        // dd($validatedData);
        // User::create($validatedData);

        // return redirect()->route('admin.category.create')->with('msg', 'Produk baru berhasil ditambahkan!');

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
        $staff = DB::table('users')
        ->join('staffs', 'users.id', '=', 'staffs.user_id')
        ->select('users.*', 'staffs.*')
        ->where('staffs.id', '=', $id)
        ->get();

        return view('staff.edit', [
            'staff' => $staff
        ]);
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

        $staff = Staff::with('user')->findOrFail($id);

        // Check if the $staff or $staff->user is null
        if (!$staff || !$staff->user) {
            return redirect()->route('admin.staff.index')->with('success', 'Data User & Staff Tidak Valid!');
        }

        $validatedData = $request->validate([
            'username' => 'required|max:16',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:45',
            'address' => 'required|max:255'
        ]);

        if (
            $staff->phone == $validatedData['phone'] &&
            $staff->address == $validatedData['address'] &&
            $staff->user->username == $validatedData['username'] &&
            $staff->user->email == $validatedData['email']
        ) {
            return redirect()->route('admin.staff.edit', ['staff' => $id])->with('msg', 'Tidak Ada Perubahan Data!');
        } else {
            $staff->phone = $validatedData['phone'];
            $staff->address = $validatedData['address'];

            // Update the user attributes
            $staff->user->username = $validatedData['username'];
            $staff->user->email = $validatedData['email'];
            $staff->user->save();

            $staff->save();

            return redirect()->route('admin.staff.index')->with('success', 'Data Staff berhasil diperbaharui!');
        }

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
        // Find the staff by ID
        $staff = Staff::findOrFail($id);

        // Delete the staff and the related users
        $staff->delete();
        
        return redirect()->back()->with('success', 'Staff berhasil dihapus.');
    }

    public function restore($id)
    {
        $staff = Staff::onlyTrashed()->findOrFail($id);

        $staff->restore();

        return redirect()->back()->with('success', 'Staff berhasil dikembalikan.');
        // return redirect()->back()->with('success', 'Staff gagal dikembalikan.');
    }

    //mendaftarkan/store akun dengan role staff ke table user
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:45',
            'username' => 'required|max:16',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'buyer'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // dd($validatedData);
        $user = User::create($validatedData);

        //update role
        $changeToStaff = User::where('email', $validatedData['email'])->first();
        $changeToStaff->role = 'staff';
        $changeToStaff->save();

        $latestID = $user->id;
        // dd($validatedData);
        return redirect()->route('owner.staff.activate', ['id' => $latestID])
        ->with('success', 'Lengkapi Data Diri Staff Berikut !');


    }

    //menampilkan form registrasi akun user
    public function formRegister(Request $request){
        return view('staff.create');
    }

    //menampilkan form data diri akun staff
    public function formActivate($id){

        return view('staff.activate', [
            'id' => $id
        ]);
    }

    //mendaftarkan/store akun dengan role staff ke table staff
    public function verifiedAccount(Request $request){

        $validatedData = $request->validate([
            'phone' => 'required|max:16',
            'address' => 'required|max:255',
            'gender' => 'required',
            'hired' => 'required',
            'birthdate' => 'required',
        ]);

        $validatedData['user_id'] = User::latest()->value('id');

        // dd($validatedData);
        Staff::create($validatedData);
        return redirect()->route('admin.staff.index')
        ->with('success', 'Berhasil Menambahkan Akun Staff Baru!');
    }

}
