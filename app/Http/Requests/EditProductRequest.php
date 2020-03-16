<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'=>'required|min:3|unique:product,code,'.$this->prd_id.',id',
            'name'=>'required|min:3|unique:product,name,'.$this->prd_id.',id',
            'price'=>'required|numeric',
            'img'=>'image' // file phải là định dạng ảnh
        ];
    }
    public function messages()
    {
        return [
            'code.required'=>'Mã sản phẩm không được để trống!',
            'code.unique'=>'Mã sản phẩm không được để trùng!',
            'code.min'=>'Mã sản phẩm phải lớn hơn 3 ký tự!',
            'name.required'=>'Tên sản phẩm không được để trống!',
            'name.unique'=>'Tên sản phẩm không được để trùng!',
            'name.min'=>'Tên sản phẩm phải lớn hơn 3 ký tự!!',
            'price.required'=>'Giá sản phẩm không được để trống!',
            'price.numeric'=>'Giá sản phẩm không đúng định dạng!',
            'img.image'=>'File Ảnh không đúng định dạng!',
        ];
    
    }
}
