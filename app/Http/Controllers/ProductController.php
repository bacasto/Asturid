<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(){
        $productos = Product::where('showProduct',1)->get();
        $categorias = Category::all();
        return view('productos.index',compact('productos','categorias'));
    }
    public function showProduct($id){
        $producto = Product::find($id);
        if($producto->showProduct==1){
            return view('productos.single',compact('producto'));
        }else{
            return redirect()->back();
        }

    }

    public function showProductCategory($idCategory){
        if($idCategory==0){
            $productos = Product::where('showProduct',1)->get();
            $category_name = "";
        }else{
            $category_name = Category::find($idCategory)->name;
            $productos = Product::where('category_id',$idCategory)
                ->where('showProduct',1)->get();
        }

        $categorias = Category::all();
        return view('productos.index',compact('productos','categorias','category_name'));
    }

    public function showProductsAdmin(){
        $productos = Product::all();
        return view('productos.admin.index',compact('productos'));
    }
    public function showUsersAdmin(){
        $users = User::all();
        return view('productos.admin.index',compact('users'));
    }
    public function updateProduct(Request $request){

        $product = Product::update([
            'id'=>$request->id
        ], [
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'stock'=>$request->stock,
            'image'=>$request->image,
            'price'=>$request->price,
            'showProduct'=>$request->showProduct,
        ]);
    }


    public function searchProducts(Request $request){
        $p_maximo = 0;
        $p_minimo = 0;

        if($request->p_max==null){
            $p_maximo = 999;
        }else{
            $p_maximo = $request->p_max;
        }
        if($request->p_min==null){
            $p_minimo = 0;
        }else{
            $p_minimo= $request->p_min;
        }
        $productos = Product::where('name','like','%'.$request->text.'%')
            ->orWhere('description','like','%'.$request->text.'%')
            ->whereBetween('price',[$p_minimo,$p_maximo])
            ->get();
        $html = view('_partial_productos',compact('productos'))->render();
        return response()->json(['status'=>'ok','html'=>$html]);
    }
}
