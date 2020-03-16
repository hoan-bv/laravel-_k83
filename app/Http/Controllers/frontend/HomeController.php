<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\{Product,Category};

class HomeController extends Controller
{
    function getIndex() {
        $data['new_prd'] = Product::where('img','<>','no-img.jpg')->orderby('id', 'desc')->take(9)->get();
        $data['featured_prd'] = Product::where('img','<>','no-img.jpg')->where('featured',1)->take(4)->get();
        return view('frontend.index', $data);
    }

    function getContact() {
        return view('frontend.contact');
    }

    function getAbout() {
        return view('frontend.about');
    }
    function getPrdCate($slug_cate){
       $data['products'] = Category::where('slug', $slug_cate)->first()->prd()->paginate(2);
      
       $data['categories'] = Category::all();
       return view('frontend.product.shop', $data);
    }
    function getFilter(request $r){
        
        $data['categories'] = Category::all();
        $data['products'] = Product::where('img','<>','no-img.jpg')->wherebetween('price',[$r->start,$r->end])->paginate(2);
        return view('frontend.product.shop', $data);
    }
}
