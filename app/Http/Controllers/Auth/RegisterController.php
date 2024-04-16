<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
  
    // use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showRegistrationForm2()
    {
        return view('auth.forgot');
    }

        public function register(Request $request)
        {
            $request->validate([
                'f_name' => 'required|string|max:255',
                'l_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                // dd($request->file('image')),

            ]);

            $imageName = ''; // Initialize imageName variable

            if ($request->hasFile('image')) {
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path('images/user/'), $imageName);
            }
                
            User::create([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $imageName,
            ]);

        return redirect()->route('home')->with('success', 'Registration successful!');

    }


    // Reset Password Form 

    function showResetForm($token){
        return view('auth.new-password',compact('token')); 
    }

    function reset(Request $request){
        $request->validate([
            
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return redirect()->to(route('password.reset'))->with('message', 'Invalide');

        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->to(route('login'))->with('message', 'Password Reset Successfully!');

    }

}
