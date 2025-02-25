@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <div class="card shadow-lg rounded-4">
            <div class="card-header text-white text-center fw-bold py-3" style="background: linear-gradient(90deg, #4b6cb7, #182848);">
                <i class="fas fa-sign-in-alt me-2"></i> {{ __('Login') }}
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn text-white fw-bold rounded-3" 
                                style="background: linear-gradient(90deg, #4b6cb7, #182848); border: none;">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none fw-bold" href="{{ route('password.request') }}" 
                               style="color: #4b6cb7;">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="text-center mt-2">
                        <p class="mb-0">{{ __('Don\'t have an account?') }} 
                            <a class="text-decoration-none fw-bold" href="{{ route('register') }}" style="color: #4b6cb7;">
                                {{ __('Register here') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
