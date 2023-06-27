<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductHasCategories;
use App\Models\ProductsHasCategories;
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
        $productAktif = Product::where('status', '1')->get();
        $productNonAktif = Product::where('status', '0')->get();

        return view('product.index', compact('productAktif', 'productNonAktif'));
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

        return view('product.create', compact('types', 'categories'));
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

        $kategori = $request->get('kategori');


        if (empty($kategori)) {
            return Redirect::back();
        } else {
            $i = 0;
            foreach ($kategori as $k) {
                if ($k != '-') {
                    $productCategories = new ProductsHasCategories();
                    $productCategories->product_id = $produk->id;
                    $productCategories->category_id = $k;
                    $productCategories->created_at = now("Asia/Bangkok");
                    $productCategories->updated_at = now("Asia/Bangkok");
                    $productCategories->save();
                    $i++;
                }
            }
        }
        return redirect()->route('product.index')->with('status', 'New Product ' .  $produk->product_name . ' is already inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Product::where('id', $id)->first();
        $types = Type::all();
        $categories = Category::all();
        $productCategories = ProductsHasCategories::where('product_id', $id)->get();

        return view('product.edit', compact('types', 'categories', 'produk', 'productCategories'));
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
        $product = Product::find($id);
        $deleteProdukCategori = ProductsHasCategories::where('product_id', $id)->delete();

        $product->product_name = $request->get('namaProduct');
        $product->image_url = $request->get('imageProduct');
        $product->price = $request->get('priceProduct');
        $product->stock = $request->get('stock');
        $product->dimension = $request->get('dimesion');
        $product->type_id = $request->get('type');
        $product->save();

        $kategori = $request->get('kategori');

        if (empty($kategori)) {
            return Redirect::back();
        } else {
            $i = 0;
            foreach ($kategori as $k) {
                if ($k != '-') {
                    $productCategories = new ProductsHasCategories();
                    $productCategories->product_id = $product->id;
                    $productCategories->category_id = $k;
                    $productCategories->created_at = now("Asia/Bangkok");
                    $productCategories->updated_at = now("Asia/Bangkok");
                    $productCategories->save();
                    $i++;
                }
            }
        }
        return redirect()->route('product.index')->with('status', 'Product ' .  $product->product_name . ' is already Updated');
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

    public static function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function nonaktifkan(Request $request)
    {
        $data = Product::find($request->get('id'));
        $data->status = '0';
        $data->save();
        return response()->json(array('status' => 'success'), 200);
    }

    public function aktifkan(Request $request)
    {
        $data = Product::find($request->get('id'));
        $data->status = '1';
        $data->save();
        return response()->json(array('status' => 'success'), 200);
    }
}
