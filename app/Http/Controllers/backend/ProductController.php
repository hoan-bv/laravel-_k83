<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{AddProductRequest,EditProductRequest};
use Illuminate\Http\Request;
use  App\models\{Product,Category};
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function getProduct() {
        $data['product'] = Product::paginate(10);
        return view('backend.product.listproduct',$data);
    }
    function getAddProduct() {
        $data['categories'] = Category::all()->toArray();
        return view('backend.product.addproduct', $data);
    }

    function postAddProduct(AddProductRequest $r) {
    
        $prd = new Product;
        $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=Str::slug($r->name);
        $prd->price=$r->price;
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;
        $prd->category_id=$r->category_id;
        if($r->hasFile('img')){
            $file=$r->img;
            $file_name = Str::slug($r->name).'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img= $file_name;
        }else{
            $prd->img= 'no-img.jpg';
        }
        $prd->save();
        return redirect('admin/product')->with('thongbao','Đã thêm thành công');
    }

    function getEditProduct($prd_id) {
        $data['prd'] = Product::find($prd_id);
        $data['cate']=Category::all();
        return view('backend.product.editproduct', $data);
    }

    function  postEditProduct(EditProductRequest $r, $prd_id) {
            $prd = Product::find($prd_id);
            $prd->code=$r->code;
        $prd->name=$r->name;
        $prd->slug=Str::slug($r->name);
        $prd->price=$r->price;
        $prd->featured=$r->featured;
        $prd->state=$r->state;
        $prd->info=$r->info;
        $prd->describe=$r->describe;
        $prd->category_id=$r->category;

        if($r ->hasFile('img')) 
        {
            if($prd->img !='no-img.jpg' )
            {
                unlink('backend/img/'.$prd->img);
            }
            $file = $r->img;
            $file_name =Str::slug($r->name).'.'.$file->getClientOriginalExtension();
            $file ->move('backend/img',$file_name);
            $prd->img = $file_name;
            
        }
        $prd -> save();
        return redirect()->back()->with('thongbao', 'Đã sửa thành công');
    }

    function getDelProduct($prd_id){
        Product::destroy($prd_id);
        return redirect('admin/product')->with('thongbao','Đã xóa thành công');
    }
}
