<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

        return view('home');
    }

    public function edit_profile(){
        
        return view('profile.edit_profile');
   }

    public function update_profile(Request $request, $id){

        $user = User::find($id);
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;

        if ($request->hasFile('image'))
        {
            if ($user->image)
             {
                $image_path ="images/user/".$user->image;
             }

            $imageName =request()->image->getClientOriginalName();
            request()->image->move(public_path('images/user/'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->back();
    }

    public function update_password(){
        
        return view('profile.password');
    }

  
}
