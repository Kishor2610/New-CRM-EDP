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

        return redirect()->back()->with('message', 'Password has been reset successfully.');

        // Session::flash('success', 'Password has been reset successfully.');
        // dd(session()->all());
        // return redirect()->back()->with('success', 'Password has been reset successfully.');
    }







    // public function showResetForm($token)
    // {
    //     return view('auth.reset-password', ['token' => $token]);
    // }

    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed|min:8',
    //         'token' => 'required'
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password)
    //             ])->save();
    //         }
    //     );


    //     if ($status === Password::PASSWORD_RESET) {
    //         event(new PasswordReset($user));
    //     }

    //     return $status == Password::PASSWORD_RESET
    //                 ? redirect()->route('login')->with('status', __($status))
    //                 : back()->withErrors(['email' => [__($status)]]);
    // }


}
