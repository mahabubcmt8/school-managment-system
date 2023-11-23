@extends('layouts.backend.app', ['pageTitle'=> 'Login'])

<div class="container">
    <div class="row justify-content-center mt-5 pt-5" >
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">
                        <strong><i class="icon-lock-open"></i>&nbsp; Login</strong>
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <label class="text-info">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-envelope"></i></span>
                                    </div>
                                    <input id="email" type="email" placeholder="john@example.com"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="text-info">Password <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" placeholder="********"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                @if (Route::has('password.request'))
                                <a class=" text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>
                            <div class="col-md-12 mt-5">
                                <button type="submit" class="btn btn-primary btn-block btn-round">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
