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
        <h5 class="text-center mb-3">Password Recover</h5>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                
                <div class="form-group">
                    <label for="email" class="col-form-label d-block text-left">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <br />

                <button type="submit" class="btn btn-primary d-block w-100 active">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
