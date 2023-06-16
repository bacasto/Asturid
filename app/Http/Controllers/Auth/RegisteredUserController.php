<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:40','min:5'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/' ,Rules\Password::defaults()],
            'phone'=>['required','string','max:15','min:5'],
            'address'=>['required','string','max:200','min:5'],
            'zip'=>['required','string','max:10','min:4'],
            'terms'=>['required','accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol_id' => 1,
            'password' => Hash::make($request->password),
            'phone'=>$request->phone,
            'address'=>$request->address,
            'zip'=>$request->zip,
        ]);

        $subject = "Bienvenid@ a Asturid";
        $data['name'] = $request->name;
        $data['email'] = $request->email; //$event->user->email;
        Mail::send('mail.mail_welcome_user',$data, function($msj) use($subject,$data){
            $msj->from(env('MAIL_FROM_ADDRESS') ,"Bienvenid@");
            $msj->subject($subject);
            $msj->to($data['email']);
        });
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
