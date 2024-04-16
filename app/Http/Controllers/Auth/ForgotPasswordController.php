<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ForgotPasswordController extends Controller
{
  
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = Str::random();

        DB::table('password_resets')->insert([
            'email' =>$request->email,
            'token' =>$token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.mail-template', ['token' => $token], function($message) use ($request){
            // $mailto:message->from('crmsystem@gmail.com', 'CRM System');
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->to(route('forgot.password'))->with('message','Email Send Successfully!');
        
        
        function showTo($token){
            return view('auth.new-password',compact('token')); 
        } 
       
    }


}