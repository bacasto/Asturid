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
    public function showMenus(){
        $menus = Menu::all();
        return view('menus.index',compact('menus'));
    }
    public function showMenu($id){
        $menu = Menu::find($id);
        return view('menus.single',compact('menu'));
    }
    public function store(Request $request){
        if (Auth::user()->rol_id == 2) {
            $request->validate([
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
            Menu::create([
                'entrante' => $request->entrante,
                'primerplato' => $request->primerplato,
                'segundoplato' => $request->segundoplato,
                'postre' => $request->postre,
                'image' => $nameFile,
                'bebida' => $request->bebida,
            ]);
            $menus = Menu::all();
            $html = view('admin._partial_menus_admin', compact('menus'))->render();
            return response()->json(['status' => 'ok', 'message' => "Producto subido correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }
    public function update(Request $request){
        if (Auth::user()->rol_id == 2) {
            $request->validate([
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

            $menu = Menu::find($request->menu_id);
            $menu->entrante = $request->entrante;
            $menu->primerplato = $request->primerplato;
            $menu->segundoplato = $request->segundoplato;
            $menu->postre = $request->postre;
            if($request->file('image')){
                $menu->image = $nameFile;
            }
            $menu->bebida = $request->bebida;

            $menu->save();
            $menus = Menu::all();
            $html = view('admin._partial_menus_admin', compact('menus'))->render();
            return response()->json(['status' => 'ok', 'message' => "Menu actualizado correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }
    public function destroy($id){
        if (Auth::user()->rol_id == 2) {
            $menu = Product::find($id);
            if ($menu) {
                if (Storage::exists('public/menus/' . $menu->image)) {
                    Storage::delete('public/menus/' . $menu->image);
                }
                $menu->delete();
            }
            $menus = Product::all();
            $html = view('admin._partial_menus_admin', compact('menus'))->render();
            return response()->json(['status' => 'ok', 'message' => "Menu eliminado correctamente", 'view' => $html], 200);

        } else {
            return response()->json(['status' => 'ok', 'message' => "No tienes permiso para hacer esto"], 403);

        }
    }
}