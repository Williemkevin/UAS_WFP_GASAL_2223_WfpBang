<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductHasCategories;
use App\Models\ProductsHasCategories;
use App\Models\Type;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $productWishlist = Wishlist::select('product_id')
            ->join('buyers', 'buyers.id', '=', 'wishlists.buyer_id')
            ->join('users', 'users.id', '=', 'buyers.user_id')
            ->where('users.id', Auth::id())
            ->get()->pluck('product_id')->toArray();
        $productAktif = Product::where('status', 'aktif')->paginate(12);
        $productNonAktif = Product::where('status', 'tidak aktif')->paginate(4);

        return view('product.index', compact('productAktif', 'productNonAktif', 'productWishlist'));
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
        $produk->image_url = $request->file('image')->store('product-image');
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
        $data->status = 'tidak aktif';
        $data->save();
        return response()->json(array('status' => 'success'), 200);
    }

    public function aktifkan(Request $request)
    {
        $data = Product::find($request->get('id'));
        $data->status = 'aktif';
        $data->save();
        return response()->json(array('status' => 'success'), 200);
    }

    public function addWishlist(Request $request)
    {
        $buyerId = Buyer::where('user_id', Auth::id())->first();

        $whislist = new Wishlist();
        $whislist->buyer_id = $buyerId->id;
        $whislist->product_id = $request->get('id');
        $whislist->save();
        return response()->json(array('status' => 'success'), 200);
    }

    public function removeWishlist(Request $request)
    {
        $buyerId = Buyer::where('user_id', Auth::id())->first();
        Wishlist::where('product_id', $request->get('id'))->where('buyer_id', $buyerId->id)->delete();
        return response()->json(array('status' => 'success'), 200);
    }

    public function cart()
    {
        return view('product.cart');
    }

    public function addToCart(Request $request)
    {
        $id = $request->get('id');
        $product = Product::find($id);
        $cart = session()->get('cart');

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "idProduk" => $product->id,
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_url,
                "stock" => $product->stock
            ];
        } else {
            $cart[$id]["quantity"]++;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Horrey Product telah ditambah');
    }

    public function removeProductCart(Request $request)
    {
        $id = $request->get('id');
        $cart = session()->get('cart');

        foreach ($cart as $key => $item) {
            if ($item['idProduk'] == $id) {
                unset($cart[$key]);
                break;
            }
        }
        session()->put('cart', $cart);
        session()->save();
        return redirect()->back()->with('success', 'Horrey Product telah ditambah');
    }

    public function updateQuantity(Request $request)
    {
        $id = $request->get('id');
        $quantity = $request->get('quantity');
        $cart = session()->get('cart');

        $stockGudang = Product::select('stock')->where('id', 1)->first();
        foreach ($cart as $key => $item) {
            if ($item['idProduk'] == $id) {
                if ($quantity <= $stockGudang->stock) {
                    $cart[$key]['quantity'] = $quantity;
                } else {
                    $cart[$key]['quantity'] = $stockGudang->stock;
                }
                break;
            }
        }
        session()->put('cart', $cart);
        session()->save();
        return redirect()->back()->with('status', 'success');
    }
}
