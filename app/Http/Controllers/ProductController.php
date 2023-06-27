<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductHasCategories;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $categories = Category::all();

        return view('product.create',compact('types','categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new Product();
        $produk->product_name = $request->get('namaProduct');
        $produk->image_url = $request->get('imageProduct');
        $produk->price = $request->get('priceProduct');
        $produk->stock = $request->get('stock');
        $produk->dimension = $request->get('dimesion');
        $produk->type_id = $request->get('type');
        $produk->save();

        if (empty($kategori)) {
            return Redirect::back();
        } else {
            $i = 0;
            foreach ($kategori as $k) {
                if ($k != '-') {
                    $product = app(ProductController::class);

                    $productCategories = new ProductHasCategories();
                    $productCategories->product_id = $product->id;
                    $productCategories->category_id = $k->id;
                    $productCategories->created_at = now("Asia/Bangkok");
                    $productCategories->updated_at = now("Asia/Bangkok");
                    $productCategories->save();
                    $i++;
                }
            }
        }
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
