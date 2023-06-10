<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showProfile()
    {
        return view('profile.edit_profile');
    }

    public function store(Request $request)
    {
        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'name' => 'required|max:250',
                'address' => 'required|string',
                'phone' => 'required|numeric',
                'rol' => 'required|exists:roles,id',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'zip' => 'required|numeric',
            ]);

            User::create([
                'name' => $request->name,
                'rol_id' => $request->rol,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'zip' => $request->zip,
                'email' => $request->email,
            ]);
            $users = User::all();
            $html = view('admin._partial_users_admin', compact('users'))->render();
            return response()->json(['status' => 'ok', 'message' => "Usuario creado correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }

    public function update(Request $request)
    {

        if (Auth::user()->rol_id == 2) {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'name' => 'required|max:250',
                'address' => 'required|string',
                'phone' => 'required|numeric',
                'rol' => 'required|exists:roles,id',
                'email' => 'required|email',
                'zip' => 'required|numeric',
                'password' => 'nullable|min:6',
            ]);
            $user = User::find($request->user_id);
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol_id = $request->rol;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->zip = $request->zip;
            $user->save();

            $users = User::all();
            $html = view('admin._partial_users_admin', compact('users'))->render();
            return response()->json(['status' => 'ok', 'message' => "Usuario actualizado correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email|'.Rule::unique('users')->ignore(Auth::id()),
            'zip' => 'required|numeric',
            'password' => 'nullable|min:6|confirmed',
        ]);
        if ($request->password) {
            Auth::user()->password = Hash::make($request->password);
        }
        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->phone = $request->phone;
        Auth::user()->address = $request->address;
        Auth::user()->zip = $request->zip;
        Auth::user()->save();
        return response()->json(['status'=>'ok']);


    }

    public function destroy($id)
    {
        if (Auth::user()->rol_id == 2) {
            $user = User::find($id);
            if ($user) {

                $user->delete();
            }
            $users = User::all();
            $html = view('admin._partial_users_admin', compact('users'))->render();
            return response()->json(['status' => 'ok', 'message' => "Usuario eliminado correctamente", 'view' => $html], 200);

        } else {
            return response()->json(['status' => 'ok', 'message' => "No tienes permiso para hacer esto"], 403);

        }
    }
}