<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|max:250',
                'address' => 'required|string',
                'phone' => 'required|numeric',
                'rol_id' => 'required|exists:roles,id',
                'email' => 'required|email',
                'zip' => 'required|numeric',
            ]);

            User::create([
                'name' => $request->name,
                'rol_id' => $request->rol_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'zip' => $request->zip,
                'email' => $request->email,
            ]);
            $usuarios = User::all();
            $html = view('admin._partial_users_admin', compact('usuarios'))->render();
            return response()->json(['status' => 'ok', 'message' => "Usuario creado correctamente", 'view' => $html], 200);
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