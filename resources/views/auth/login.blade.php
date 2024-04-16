@extends('layouts.master')

@section('content')

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo" style="font-family: 'Times New Roman', Times, serif; color: white;">
        <h1>CRM System</h1>
    </div>
    <div class="login-box">
       
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
        
            <div class="form-group">
                <label class="control-label">USERNAME</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                 @error('email')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
                 @enderror
            </div>
           
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox"><span class="label-text">Stay Signed in</span>
                        </label>
                    </div>
                    <p class="mb-2"><a href="{{ route('password.request') }}">Forgot Your Password?</a></p>
                </div>
            </div>
                
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>

            <div class="text-center">
                <p>Don't have an account? <a href="{{ route('register') }}">Register Here</a></p>
            </div>
            
        </form>
    </div>
</section>

@endsection
