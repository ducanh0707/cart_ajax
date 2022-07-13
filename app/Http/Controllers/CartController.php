<?php

namespace App\Http\Controllers;
use DB;
use App\Cart;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;

class CartController extends Controller
{
    public function Index()
    {
        $product = DB::table('products')->get();
       return view('index')->with('product',$product);
    }
    public function AddCart(Request $request,$id)
    {
        $product= DB::table('products')->where('id',$id)->first();
        if ($product) {
            $oldCart= Session('Cart') ? Session('Cart') : null;
            $newCart= new Cart($oldCart);
            $newCart->AddCart($product,$id);

            session::put('Cart',$newCart);
            // $request->session()->put('Cart',$newCart);
            // dd($newCart);
        }
        return view('cart')->with('newCart',$newCart );

    }
    public function DeleteitemCart(Request $request,$id)
    {
            $oldCart= Session('Cart') ? Session('Cart') : null;

            $newCart= new Cart($oldCart);
            $newCart->DeleteitemCart($id);
            if(Count($newCart->products) > 0 ){
            session::put('Cart',$newCart);
            // $request->session()->put('Cart',$newCart);
            }else
            {
            // $request->session()->forget('Cart');
            session::forget('Cart');

            }

        return view('cart')->with('newCart',$newCart );

    }
    public function ViewListCart()
    {
        return view('list');
    }
    public function DeleteitemListCart(Request $request,$id)
    {
            $oldCart= Session('Cart') ? Session('Cart') : null;

            $newCart= new Cart($oldCart);
            $newCart->DeleteitemCart($id);
            if(Count($newCart->products) > 0 ){
            session::put('Cart',$newCart);
            // $request->session()->put('Cart',$newCart);
            }else
            {
            // $request->session()->forget('Cart');
            session::forget('Cart');
            }
        return view('list-cart')->with('newCart',$newCart );

    }
    public function SaveitemListCart(Request $request,$id, $quanty)
    {
        $oldCart= Session('Cart') ? Session('Cart') : null;

        $newCart= new Cart($oldCart);
        $newCart->UpdateitemCart($id,$quanty);
        if(Count($newCart->products) > 0 ){
        // session::put('Cart',$newCart);
        $request->session()->put('Cart',$newCart);
        }else
        {
        $request->session()->forget('Cart');
        // session::forget('Cart');
        }
    return view('list-cart')->with('newCart',$newCart );

    }
}
