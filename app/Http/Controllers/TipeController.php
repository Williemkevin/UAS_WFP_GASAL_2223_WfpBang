<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Display all types & soft deleted
        $types = Type::all();

        $softDeletedTypes = Type::withTrashed()
        ->onlyTrashed()
        ->get();

        return view('type.index',[
            'types' => $types,
            'deleted_types' => $softDeletedTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Display add new category
        return view('type.create');
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
        //
        $validatedData = $request->validate([
            'type_name' => 'required|max:45',
            'description' => 'required|max:255'
        ]);
        // dd($validatedData);
        Type::create($validatedData);

        return redirect()->route('admin.type.create')->with('msg', 'Tipe baru berhasil ditambahkan!');
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
        $type = Type::find($id);
        return view('type.edit', [
            'type' => $type
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
        //
        $type = Type::find($id);

        $validatedData = $request->validate([
            'type_name' => 'required|max:45',
            'description' => 'required|max:255'
        ]);

        if ($type->type_name == $validatedData['type_name'] && $type->description == $validatedData['description']) {
            // dd('same data');
            return redirect()->route('admin.type.edit', ['type' => $id])->with('msg', 'Tidak Ada Perubahan Data!');
        } else {
            // dd('data changed');
            $type->type_name = $validatedData['type_name'];
            $type->description = $validatedData['description'];

            Type::where('id', $id)->update($validatedData);

            return redirect()->route('admin.type.index')->with('success', 'Tiper berhasil diperbaharui!');
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
        $type = Type::findOrFail($id);

        $type->delete();

        return redirect()->back()->with('success', 'Tipe berhasil dihapus.');
    }

    public function restore($id)
    {
        $type = Type::withTrashed()->findOrFail($id);

        if ($type->trashed()) {
            $type->restore();

            return redirect()->back()->with('success', 'Tipe berhasil dikembalikan.');
        }
        return redirect()->back()->with('success', 'Tipe gagal dikembalikan.');
    }
}
