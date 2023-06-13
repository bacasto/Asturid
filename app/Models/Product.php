<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name','category_id','description','stock','image','price','showProduct'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }


}
