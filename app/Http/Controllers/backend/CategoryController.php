<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{AddCategoryRequest,EditCategory};
use Illuminate\Http\Request;
use App\models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function getCategory() {
        $data['categories'] = Category::all();
        return view('backend.category.category', $data);
    }
    function postAddCategory(AddCategoryRequest $r){
        
        if(GetLevel(Category::all()->toArray(),$r->parent, 1) > 2){
            return redirect()->back()->with('error','Danh mục không được lớn hơn 2 cấp');

        }
        $category = new Category;
        $category ->name = $r ->name;
        $category->slug =Str::slug($r->name, '-');
        $category ->parent = $r ->parent;
        $category -> save();
        return redirect()->back()->with('thongbao', ' Đã thêm danh mục:'.$r->name.' thành công!');
    }

    function getEditCategory($id_category) {
       $data['cate']=Category::find($id_category);
       $data['categories']=Category::all()->toArray();
        return view('backend.category.editcategory',$data);
    }

    function postEditCategory(EditCategory $r,$id_category){

        if(GetLevel(Category::all()->toArray(),$r->parent, 1) > 2){
            return redirect()->back()->with('error','Danh mục không được lớn hơn 2 cấp');
        }

        $category =  Category::find($id_category);
        $category ->name = $r ->name;
        $category->slug =Str::slug($r->name, '-');
        $category ->parent = $r ->parent;
        $category -> save();
        return redirect()->back()->with('thongbao', ' Đã sửa danh mục:'.$r->name.' thành công!');
    }

    function getDelCategory($id_category){
        $category = Category::find($id_category);
        Category::where('parent', $id_category)->update(['parent'=> $category->parent]);
        Category::destroy($id_category);
        return redirect()->back()->with('thongbao','Đã xóa danh mục:'.$category->name.' thành công!');
    }
    

}
