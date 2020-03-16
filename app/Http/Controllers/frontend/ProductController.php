<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\{Product,Category};

class ProductController extends Controller
{
    function getShop() {
        $data['products'] = Product::where('img','<>','no-img.jpg')->paginate(6);
        $data['categories'] = Category::all();
        return view('frontend.product.shop', $data);
    }

    function getDetail($slug_prd) {

        $data['prd_new'] = Product::where('img','<>','no-img.jpg')->orderby('id','desc')->take(4)->get();
        $data['prd'] = Product::where('slug', $slug_prd)->first();
        return view('frontend.product.detail', $data);
    }
}
