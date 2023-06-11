<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;

class ExtrasController extends Controller
{
    public function showExtrasAdmin()
    {
        $extras = Extra::all();
        return view('admin.extras_index',compact('extras'));
    }

    public function store(Request $request){
            $request->validate([
                'name'=>'required|string|max:250',
                'category'=>'required|exists:categories,id'
            ]);
            Extra::create([
                'name'=>$request->name,
                'category_id'=>$request->category,
            ]);
            $extras = Extra::all();
        $html = view('admin._partial_extras_admin', compact('extras'))->render();
        return response()->json(['status' => 'ok', 'message' => "Extra creado correctamente", 'view' => $html], 200);

    }
    public function update(Request $request){

    }
    public function destroy($id){

    }
}