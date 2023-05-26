<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $productos = Product::all();
        $categorias = Category::all();
        //dd($categorias);
        return view('productos.index',compact('productos',), compact('id_categoria'));
    }
    public function showProduct($id){
        $producto = Product::find($id);
        return view('productos.single',compact('producto'));
    }

    public function showProductCategory(){
        $category = Category::find($idCategory);
        $producto = Product::where('category_id');
    }

    public function updateProduct(Request:$request){
        $product = Product::update([
            'id'=>$requets->id
        ])
    }
}