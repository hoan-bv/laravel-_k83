<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\models\{Order, ProductOrder};
use Cart;
use CarBon\CarBon;

class CheckoutController extends Controller
{
    function getCheckout() {
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total(0,"",".");
        return view('frontend.checkout.checkout', $data);
    }

    function postCheckout(CheckoutRequest $r) {
        
        $order = new Order;
        $order ->full = $r->name;
        $order ->address = $r->address;
        $order ->phone = $r->phone;
        $order ->email = $r->email;
        $order ->total =Cart::total(0,"","");
        $order ->state =2;
        $order->save();
        foreach(Cart::content() as $row){
            $product_order = new ProductOrder;
            $product_order ->code = $row->id;
            $product_order ->name = $row->name;
            $product_order ->price = $row->price;
            $product_order ->qty = $row->qty;
            $product_order ->img = $row->options->img;
            $product_order ->order_id = $order->id;
            $product_order->save();
        }
        Cart::destroy();
        return redirect('/checkout/complete/'.$order->id);

    }

    function getComplete($order_id) {
        $data['order'] = Order::find($order_id);
        return view('frontend.checkout.complete',$data);
    }
}
