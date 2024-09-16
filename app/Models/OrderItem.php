<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity', 
        'price', 
        'product_id', 
        'order_id'
    ];

    //relationship 
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function products(){
        return $this->belongsTo(Product::class);
    }
}
