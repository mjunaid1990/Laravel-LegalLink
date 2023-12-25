@extends('layouts.auth')

@section('title', 'Verify Email')

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
        <h5 class="text-center mb-3">{{ __('Verify Your Email Address') }}</h5>

        <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
