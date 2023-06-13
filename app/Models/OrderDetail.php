<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = ['order_id','product_id','menu_id'];
    public function order(){
        return $this->belongsTo(User::class,'order_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
}
