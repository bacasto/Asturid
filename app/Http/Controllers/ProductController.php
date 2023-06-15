<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::where('showProduct', 1)->get();
        $categorias = Category::all();
        return view('productos.index', compact('productos', 'categorias'));
    }

    public function showProduct($id)
    {
        $producto = Product::find($id);
        if ($producto->showProduct == 1) {
            return view('productos.single', compact('producto'));
        } else {
            return redirect()->back();
        }

    }

    public function showProductCategory($idCategory)
    {
        if ($idCategory == 0) {
            $productos = Product::where('showProduct', 1)->get();
            $category_name = "";
            $category_id = "";
        } else {
            $category = Category::find($idCategory);
            $productos = Product::where('category_id', $idCategory)
                ->where('showProduct', 1)->get();
            $category_name = $category->name;
            $category_id = $category->id;
        }

        $categorias = Category::all();
        return view('productos.index', compact('productos', 'categorias', 'category_name', 'category_id'));
    }

    public function searchProducts(Request $request)
    {
        $p_maximo = 0;
        $p_minimo = 0;

        if ($request->p_max == null) {
            $p_maximo = 999999;
        } else {
            $p_maximo = $request->p_max;
        }
        if ($request->p_min == null) {
            $p_minimo = 0;
        } else {
            $p_minimo = $request->p_min;
        }

        if ($request->category_id == 0) {
            $productos = Product::where('price', '>=', $p_minimo)
                ->where('price', '<=', $p_maximo)
                ->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->text . '%')
                        ->orWhere('description', 'like', '%' . $request->text . '%');
                })
                ->get();
        } else {
            $productos = Product::where('price', '>=', $p_minimo)
                ->where('price', '<=', $p_maximo)
                ->where('category_id', $request->category_id)
                ->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->text . '%')
                        ->orWhere('description', 'like', '%' . $request->text . '%');
                })
                ->get();
        }

        $html = view('productos._partial_productos', compact('productos'))->render();
        return response()->json(['status' => 'ok', 'html' => $html]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|max:250',
                'description' => 'required|string',
                'stock' => 'required|numeric',
                'category' => 'required|exists:categories,id',
                'show' => 'required',
                'price' => 'required|numeric',
                'image' => 'required|image',
            ]);
            $show = $request->show == "true" ? 1 : 0;
            $path = null;
            if ($request->file('image')) {
                $image = $request->file('image');
                $nameFile = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/productos', $nameFile);
            }
            Product::create([
                'name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'stock' => $request->stock,
                'image' => $nameFile,
                'price' => $request->price,
                'showProduct' => $show,
            ]);
            $productos = Product::all();
            $html = view('admin._partial_products_admin', compact('productos'))->render();
            return response()->json(['status' => 'ok', 'message' => "Producto subido correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }

    public function updateProduct(Request $request)
    {
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|max:250',
                'description' => 'required|string',
                'stock' => 'required|numeric',
                'category' => 'required|exists:categories,id',
                'show' => 'required',
                'price' => 'required|numeric',
                'image' => 'nullable',
            ]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $nameFile = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/productos', $nameFile);
            }

            $product = Product::find($request->product_id);
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->description = $request->description;
            $product->stock = $request->stock;
            if($request->file('image')){
                $product->image = $nameFile;
            }
            $product->price = $request->price;
            $product->showProduct = $request->show == "true" ? 1 : 0;
            $product->save();
            $productos = Product::all();
            $html = view('admin._partial_products_admin', compact('productos'))->render();
            return response()->json(['status' => 'ok', 'message' => "Producto actualizado correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->rol_id == 2) {
            $product = Product::find($id);
            if ($product) {
                if (Storage::exists('public/productos/' . $product->image)) {
                    Storage::delete('public/productos/' . $product->image);
                }
                $product->delete();
            }
            $productos = Product::all();
            $html = view('admin._partial_products_admin', compact('productos'))->render();
            return response()->json(['status' => 'ok', 'message' => "Producto eliminado correctamente", 'view' => $html], 200);

        } else {
            return response()->json(['status' => 'ok', 'message' => "No tienes permiso para hacer esto"], 403);
        }
    }
}
