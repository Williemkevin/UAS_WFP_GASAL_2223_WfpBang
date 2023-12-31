<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Display all category & soft deleted
        $categories = Category::all();

        $softDeletedCategories = Category::withTrashed()
        ->onlyTrashed()
        ->get();

        return view('category.index', 
            [
                'categories'=>$categories,
                'deleted_categories'=>$softDeletedCategories
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Display add new category
        return view('category.create');
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
        $validatedData = $request->validate([
            'category_name' => 'required|max:45',
            'description' => 'required|max:255'
        ]);
        // dd($validatedData);
        Category::create($validatedData);

        return redirect()->route('admin.category.create')->with('msg', 'Produk baru berhasil ditambahkan!');

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
        $category = Category::find($id);
        return view('category.edit', [
            'category' => $category
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
        $category = Category::find($id);

        $validatedData = $request->validate([
            'category_name' => 'required|max:45',
            'description' => 'required|max:255'
        ]);

        if($category->category_name == $validatedData['category_name'] && $category->description == $validatedData['description']){
            // dd('same data');
            return redirect()->route('admin.category.edit', ['category' => $id])->with('msg', 'Tidak Ada Perubahan Data!');
        }
        else{
            // dd('data changed');
            $category->category_name = $validatedData['category_name'];
            $category->description = $validatedData['description'];

            Category::where('id', $id)->update($validatedData);

            return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbaharui!');


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
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus!');
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');

    }

    // restore soft deleted categories

    public function restore($id){
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->trashed()) {
            $category->restore();

            // Perform any additional logic after restoring the category

            return redirect()->back()->with('success', 'Kategori berhasil dikembalikan.');
        }
        return redirect()->back()->with('success', 'Kategori gagal dikembalikan.');
    }
}
