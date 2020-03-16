<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Order;
class OrderController extends Controller
{
    function getOrder() {
        $data['order'] = Order::where('state',2)->orderby('id','desc')->paginate(2);
        return view('backend.order.order', $data);
    }
    function getDetail($order_id) {
        $data['order'] = Order::find($order_id);
        return view('backend.order.detailorder', $data);
    }
    function getProcessed() {
        $data['order'] = Order::where('state',1)->orderby('updated_at','desc')->paginate(1);
        return view('backend.order.processed', $data);
    }
}
