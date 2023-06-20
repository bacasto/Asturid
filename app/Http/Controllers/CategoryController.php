<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function showCategoriesAdmin()
    {
        $categorias = Category::all();
        return view('admin.categories_index',compact('categorias'));
    }

    public function store(Request $request){
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|string|max:250',
            ]);
            Category::create([
                'name' => $request->name,
            ]);
            $categorias = Category::all();
            $html = view('admin._partial_categorias_admin', compact('categorias'))->render();
            return response()->json(['status' => 'ok', 'message' => "Categoría creada correctamente", 'view' => $html], 200);
        }else{
            return response()->json(['status' => 'error',], 403);

        }
    }
    public function update(Request $request){
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name'=>'required|string|max:250',
                'categoria_id'=>'required|exists:categories,id'
            ]);
            Category::find($request->categoria_id)->update([
                'name'=>$request->name
            ]);
            $categorias = Category::all();
            $html = view('admin._partial_categorias_admin', compact('categorias'))->render();
            return response()->json(['status' => 'ok', 'message' => "Categoría editada correctamente", 'view' => $html], 200);
        }else{
            return response()->json(['status' => 'error',], 403);
        }
    }
    public function destroy($id){
        if (Auth::user()->rol_id == 2) {
            $categoria = Category::find($id);
            if($categoria){
                $categoria->delete();
                $categorias = Category::all();
                $html = view('admin._partial_categorias_admin', compact('categorias'))->render();
                return response()->json(['status' => 'ok', 'message' => "Categoría eliminada correctamente", 'view' => $html], 200);

            }else{
                return response()->json(['status' => 'error',], 406);
            }
        }else{
            return response()->json(['status' => 'error',], 403);
        }

    }
}
