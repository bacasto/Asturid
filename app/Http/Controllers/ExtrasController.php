<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExtrasController extends Controller
{
    public function showExtrasAdmin()
    {
        $extras = Extra::all();
        return view('admin.extras_index',compact('extras'));
    }

    public function store(Request $request){
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|string|max:250',
                'category' => 'required|exists:categories,id'
            ]);
            Extra::create([
                'name' => $request->name,
                'category_id' => $request->category,
            ]);
            $extras = Extra::all();
            $html = view('admin._partial_extras_admin', compact('extras'))->render();
            return response()->json(['status' => 'ok', 'message' => "Extra creado correctamente", 'view' => $html], 200);
        }else{
            return response()->json(['status' => 'error',], 403);

        }
    }
    public function update(Request $request){
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name'=>'required|string|max:250',
                'extra_id'=>'required|exists:extras,id',
                'category'=>'required|exists:categories,id'
            ]);
            Extra::find($request->extra_id)->update([
                'name'=>$request->name,
                'category_id'=>$request->category,
            ]);
            $extras = Extra::all();
            $html = view('admin._partial_extras_admin', compact('extras'))->render();
            return response()->json(['status' => 'ok', 'message' => "Extra editado correctamente", 'view' => $html], 200);
        }else{
            return response()->json(['status' => 'error',], 403);
        }
    }
    public function destroy($id){
        if (Auth::user()->rol_id == 2) {
            $extra = Extra::find($id);
            if($extra){
                $extra->delete();
                $extras = Extra::all();
                $html = view('admin._partial_extras_admin', compact('extras'))->render();
                return response()->json(['status' => 'ok', 'message' => "Extra eliminado correctamente", 'view' => $html], 200);

            }else{
                return response()->json(['status' => 'error',], 406);
            }
        }else{
            return response()->json(['status' => 'error',], 403);
        }

    }
}
