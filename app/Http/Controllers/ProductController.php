<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    //
    public function index()
    {
        $data = Product::all();
        return view('product', ['products' => $data]);
    }

    public function detail($id)
    {
        $data = Product::find($id);
        return view('detail', ['detail' => $data]);
    }

    public function search(Request $req)
    {
        //$data = Product::find($id);
        //return view('detail', ['detail' => $data]);
        $data = Product::where('name', 'like', '%' . $req->input('query') . '%')->get();
        return view('search', ['results' => $data]);
    }

    public function addToCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new cart;

            // get ID from session
            $cart->user_id = $req->session()->get('user')['id'];

            // get product_id from form input
            $cart->product_id = $req->product_id;

            $cart->save();

            return redirect('/');

        } else {
            return redirect('/login');
        }
    }

    public static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return cart::where('user_id', $userId)->count();
    }
}
