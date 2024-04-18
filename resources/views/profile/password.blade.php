@extends('layouts.master')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Change Password  </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#"> Change Password  </a></li>
            </ul>
        </div>
        <div  class="col-md-6 offset-md-3">
                 <div class="tile">

                    <script>
                         @if(session('success'))
                                <strong>{{ session('success') }}</strong>
                        @endif
                    </script>


                         <div class="col-lg-12">
                             <div>
                                 <div>
                                 <img width="60 px" class="app-sidebar__user-avatar"  src="{{ asset('images/user/'.Auth::user()->image) }}" alt="User Image">
                                    <p><span class="badge badge-dark">{{ Auth::user()->fullname }}</span></p>
                                  </div>
                             </div>
                             <form method="POST" action="{{ route('password.update') }}">
                                 @csrf

                                 <div class="form-group row">
                                     <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                     <div class="col-md-6">
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" required autocomplete="email" readonly>
                                        

                                         @error('email')
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                     <div class="col-md-6">
                                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                         @error('password')
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                     <div class="col-md-6">
                                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                     </div>
                                 </div>

                                 <div class="form-group row mb-0">
                                     <div class="col-md-6 offset-md-4">
                                         <button type="submit" class="btn btn-primary">
                                             {{ __('Reset Password') }}
                                         </button>
                                     </div>
                                 </div>
                             </form>
                        </div>
                     <div class="tile-footer">
                    </div>
             </div>
        </div>
     </main>

 @endsection