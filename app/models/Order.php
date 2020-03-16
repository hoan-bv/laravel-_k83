<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order';

    public function ProductOrder()
    {
        return $this->hasMany('App\models\ProductOrder','order_id', 'id');
    }
}
