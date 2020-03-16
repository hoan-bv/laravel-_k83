<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use Cart;

class CartController extends Controller
{
    function getCart() {
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total(0,"",".");

        return view('frontend.cart.cart', $data);
    }
    function AddCart(request $r){
        $prd = Product::find($r->id_prd);
        if($r -> has('qty')){
            $qty = $r->quantity;
        }else{
            $qty = 1;
        }
        Cart::add([
            'id' => $prd->code, 
            'name' => $prd->name, 
            'qty' => $qty, 
            'price' => $prd->price, 
            'weight' => 0, 
            'options' => ['img' => $prd->img]]);
            return redirect('/cart');

    }
    function UpdateCart($rowId, $qty){
        Cart::update($rowId, $qty);
        return "success";
    }
    function DelCart($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
}
