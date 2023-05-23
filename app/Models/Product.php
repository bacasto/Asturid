<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /*$table->id();
            $table->string('name',250);
            $table->unsignedBigInteger('category_id');
            $table->text('description');
            $table->integer('stock');
            $table->string('image',250);
            $table->decimal(8,2);
            $table->smallInteger('showProduct');
            $table->timestamps();*/

        protected $table = "products";
        protected $fillable = [
            'name', 'category_id', 'desciption', 'stock', 'image', 'price', 'showProduct'
        ];

        public function category(){
            return $this->belongsTo(Category::class,'category_id','id');
        }
}
