@extends('layouts.auth')
@section('title', 'Confirm Password')
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
        <h5>{{ __('Confirm Password') }}</h5>

        <div class="card-body">
            {{ __('Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group">
                    <label for="password" class="col-form-label d-block text-left">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <br />
                
                <button type="submit" class="btn btn-primary active w-100 d-block">
                    {{ __('Confirm Password') }}
                </button>
                
                <br />
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
