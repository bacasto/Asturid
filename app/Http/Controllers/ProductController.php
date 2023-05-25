<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $productos = Product::all();

    return view ('productos.index', compact('productos'));
    }
}
