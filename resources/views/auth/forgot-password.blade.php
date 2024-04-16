@extends('layouts.master')

@section('content')

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo" style="font-family: 'Times New Roman', Times, serif; color: white;">
        <h1>CRM System</h1>
    </div>

    <div class="login-box" style="min-height: 330px;">

        <form class="login-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password?</h3>
            <div>
                
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
           
            <div class="form-group">
                <label class="control-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg fa-fw"></i>Send Password Reset Link</button>
            </div>
            <div class="text-center">
                <p>Remembered your password? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </form>
    </div>
@endsection