<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';

    public function IdCategory()
    {
        return $this->belongsTo('App\models\category', 'category_id', 'id');
    }
}