<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class ResetPasswordController extends Controller
{
    
    public function showResetForm(Request $request, $token = null)
    {
        return view('profile.password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success', 'Password has been reset successfully.');
        // dd(session()->all());
        return redirect()->back()->with('success', 'Password has been reset successfully.');
    }


}
