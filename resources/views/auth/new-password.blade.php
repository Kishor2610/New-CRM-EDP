@extends('layouts.master')

@section('content')

<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo" style="font-family: 'Times New Roman', Times, serif; color: white;">
        <h1>CRM System</h1>
    </div>

    <div class="login-box" style="min-height: 430px;">

        <form class="login-form" method="POST" action="{{ route('password.update')}}">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Reset Password</h3>
            <input type="text" name="token" hidden value="{{ $token }}">
            <div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="control-label">Email Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            </div>

            {{-- New Password --}}
            <div class="form-group">
                <label class="control-label">New Password</label>
                <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePasswordVisibility()" style="cursor: pointer;">
                            <i class="fa fa-eye" id="togglePassword"></i>
                        </span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Confirm password --}}
            <div class="form-group">
                <label class="control-label">Confirm Password</label>
                <div class="input-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="toggleConfirmPasswordVisibility()" style="cursor: pointer;">
                            <i class="fa fa-eye" id="togglePassword2"></i>
                        </span>
                    </div>
                </div>
            </div>


            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-lock fa-lg fa-fw"></i>Reset Password</button>
            </div>
        </form>
    </div>
@endsection



@push('js')

<script type="text/javascript">
    
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.getElementById("togglePassword");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }


    function toggleConfirmPasswordVisibility() {
        var passwordField = document.getElementById("password-confirm");
        var toggleIcon = document.getElementById("togglePassword2");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

</script>
