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
            $category_id = "";
        }else{
            $category = Category::find($idCategory);
            $productos = Product::where('category_id',$idCategory)
                ->where('showProduct',1)->get();
            $category_name = $category->name;
            $category_id = $category->id;
        }

        $categorias = Category::all();
        return view('productos.index',compact('productos','categorias','category_name','category_id'));
    }

    public function showProductsAdmin(){
        $productos = Product::all();
        return view('admin.products_index',compact('productos'));
    }
    public function showUsersAdmin(){
        $users = User::all();
        return view('admin.users_index',compact('users'));
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

        if($request->category_id == 0){
            $productos = Product::where('price','>=',$p_minimo)
                ->where('price','<=',$p_maximo)
                ->where(function ($q) use($request){
                    $q->where('name','like','%'.$request->text.'%')
                        ->orWhere('description','like','%'.$request->text.'%');
                })
                ->get();
        }else{
            $productos = Product::where('price','>=',$p_minimo)
                ->where('price','<=',$p_maximo)
                ->where('category_id',$request->category_id)
                ->where(function ($q) use($request){
                    $q->where('name','like','%'.$request->text.'%')
                        ->orWhere('description','like','%'.$request->text.'%');
                })
                ->get();
        }

        $html = view('productos._partial_productos',compact('productos'))->render();
        return response()->json(['status'=>'ok','html'=>$html]);
    }
}