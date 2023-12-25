@extends('layouts.auth')

@section('title', 'Password Reset')

@section('css')
<style>
    #app {
        background-color: #F0F0F0;
    }
    .center-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .center-content .cards {
        position: relative;
        display: flex;
        flex-direction: column;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #F0F0F0;
        border-radius: 14px;
    }
    .center-content .cards img {
        height: 50px;
        width: 50px;
        margin: 0 auto;
        margin-bottom: 15px;
    }
</style>
@endsection
@section('content')

<div class="container center-content">
    <div class="cards">
        <img src="/assets/img/legal/small-logo.png" alt="" />
        <h5 class="text-center mb-3">Password Reset</h5>
        <div class="card-body">
            

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email" class="col-form-label d-block text-left">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                

                <div class="form-group">
                    <label for="password" class="col-form-label d-block text-left">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-form-label d-block text-left">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                
                <br />

                <button type="submit" class="btn btn-primary w-100 active d-block">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</div>


@endsection
