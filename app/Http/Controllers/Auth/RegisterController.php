<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;



class RegisterController extends Controller
{
  
    // use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.register');
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




}
