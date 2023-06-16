<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function showMenus()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function showMenu($id)
    {
        $menu = Menu::find($id);
        return view('menus.single', compact('menu'));
    }

    //TODO=>Crear ruta
    public function searchMenus(Request $request)
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
        $menus = Menu::where('name','like','%'.$request->text.'%')
            ->where('price', '>=', $p_minimo)
            ->where('price', '<=', $p_maximo)
            ->get();
        $html = view('menus._partial_menus', compact('menus'))->render();
        return response()->json(['status' => 'ok', 'html' => $html]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|string',
                'entrante' => 'required|exists:products,id',
                'primerplato' => 'required|exists:products,id',
                'segundoplato' => 'required|exists:products,id',
                'postre' => 'required|exists:products,id',
                'bebida' => 'required|exists:products,id',
                'image' => 'required|image',
            ]);

            $path = null;
            if ($request->file('image')) {
                $image = $request->file('image');
                $nameFile = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/menus', $nameFile);
            }
            $priceTotal = 0;
            $priceTotal += Product::find($request->entrante)->price;
            $priceTotal += Product::find($request->primerplato)->price;
            $priceTotal += Product::find($request->segundoplato)->price;
            $priceTotal += Product::find($request->postre)->price;
            $priceTotal += Product::find($request->bebida)->price;
            Menu::create([
                'name' => $request->name,
                'entrante_id' => $request->entrante,
                'primerplato_id' => $request->primerplato,
                'segundoplato_id' => $request->segundoplato,
                'postre_id' => $request->postre,
                'image' => $nameFile,
                'bebida_id' => $request->bebida,
                'price' => $priceTotal,
            ]);
            $menus = Menu::all();
            $html = view('admin._partial_menus_admin', compact('menus'))->render();
            return response()->json(['status' => 'ok', 'message' => "Producto subido correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }

    public function update(Request $request)
    {
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|string',
                'entrante' => 'required|exists:products,id',
                'primerplato' => 'required|exists:products,id',
                'segundoplato' => 'required|exists:products,id',
                'postre' => 'required|exists:products,id',
                'bebida' => 'required|exists:products,id',
                'image' => 'nullable',
            ]);

            if ($request->file('image')) {
                $image = $request->file('image');
                $nameFile = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/menus', $nameFile);
            }
            $priceTotal = 0;
            $priceTotal += Product::find($request->entrante)->price;
            $priceTotal += Product::find($request->primerplato)->price;
            $priceTotal += Product::find($request->segundoplato)->price;
            $priceTotal += Product::find($request->postre)->price;
            $priceTotal += Product::find($request->bebida)->price;

            $menu = Menu::find($request->menu_id);
            $menu->name = $request->name;
            $menu->entrante_id = $request->entrante;
            $menu->primerplato_id = $request->primerplato;
            $menu->segundoplato_id = $request->segundoplato;
            $menu->postre_id = $request->postre;
            if ($request->file('image')) {
                $menu->image = $nameFile;
            }
            $menu->bebida_id = $request->bebida;
            $menu->price = $priceTotal;

            $menu->save();
            $menus = Menu::all();
            $html = view('admin._partial_menus_admin', compact('menus'))->render();
            return response()->json(['status' => 'ok', 'message' => "Menu actualizado correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }

    public function destroy($id)
    {

        if (Auth::user()->rol_id == 2) {
            $menu = Menu::find($id);
            if ($menu) {
                if (Storage::exists('public/menus/' . $menu->image)) {
                    Storage::delete('public/menus/' . $menu->image);
                }
                $menu->delete();
            }
            $menus = Menu::all();
            $html = view('admin._partial_menus_admin', compact('menus'))->render();
            return response()->json(['status' => 'ok', 'message' => "Menu eliminado correctamente", 'view' => $html], 200);

        } else {
            return response()->json(['status' => 'ok', 'message' => "No tienes permiso para hacer esto"], 403);

        }
    }
}
