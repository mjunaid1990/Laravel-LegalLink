@extends('layouts.auth')

@section('title', 'Login')

@section('content')


<section class="sign-up">
    <div class="row">
        <div class="col-12 col-md-6 sign-up-pd">
            <div class="sign-up auth-inner-box">
                <h4> Sign In</h4>
                <p>Enter Your email and password for sign in</p>
                
                <div class="text-center my-3">
                    <a href="/auth/google" class="btn btn-primary w-100 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M17.855 7.33397C17.935 7.33397 17.9999 7.39884 17.9999 7.47885V8.99995C17.9999 9.56926 17.947 10.1259 17.8456 10.6659C17.061 14.8604 13.3658 18.0302 8.93648 17.9996C3.9665 17.9654 -0.0109811 13.9497 2.27767e-05 8.97966C0.0109563 4.01855 4.03625 0 8.99994 0C11.4318 0 13.6382 0.964752 15.2582 2.53187C15.3167 2.58843 15.3182 2.68167 15.2607 2.73918L13.1087 4.89112C13.0533 4.94653 12.9638 4.94797 12.907 4.89393C11.8903 3.92612 10.5146 3.33195 8.99994 3.33195C5.87207 3.33195 3.35331 5.83281 3.33208 8.96061C3.31074 12.1089 5.8566 14.6679 8.99994 14.6679C11.5503 14.6679 13.7074 12.9831 14.4187 10.6659H9.14481C9.0648 10.6659 8.99994 10.6011 8.99994 10.521V7.47882C8.99994 7.3988 9.0648 7.33394 9.14481 7.33394H17.855V7.33397Z" fill="#2196F3"/>
                        <path d="M17.8559 7.33447H16.7694C16.8494 7.33447 16.9143 7.39934 16.9143 7.47935V9.00045C16.9143 9.56976 16.8614 10.1264 16.76 10.6664C16.0115 14.668 12.6138 17.7369 8.45703 17.9842C8.61608 17.9935 8.77618 17.999 8.9374 18.0002C13.3667 18.0307 17.0619 14.8608 17.8465 10.6664C17.9479 10.1264 18.0008 9.56976 18.0008 9.00045V7.47932C18.0008 7.39934 17.9359 7.33447 17.8559 7.33447Z" fill="#1E88E5"/>
                        <path d="M3.85245 6.62628L1.11914 4.65136C2.65258 1.87786 5.60751 0 9.00071 0C11.4326 0 13.639 0.964752 15.259 2.53187C15.3175 2.58843 15.319 2.68167 15.2614 2.73918L13.1095 4.89112C13.0542 4.94642 12.9647 4.94814 12.9081 4.89421C11.8913 3.92623 10.5155 3.33198 9.00071 3.33198C6.71795 3.33198 4.75027 4.68141 3.85245 6.62628Z" fill="#F44336"/>
                        <path d="M3.0625 6.0562L3.85158 6.62633C4.67106 4.85116 6.38204 3.57267 8.41019 3.36297C8.42545 3.36132 8.44011 3.35931 8.45565 3.35784C8.27716 3.34089 8.09628 3.33203 7.91333 3.33203C5.85118 3.33203 4.05401 4.41916 3.0625 6.0562Z" fill="#E53935"/>
                        <path d="M14.1721 2.53187C14.2306 2.58843 14.2321 2.68167 14.1746 2.73922L12.4279 4.48588C12.5953 4.61314 12.7555 4.74927 12.9075 4.89397C12.9642 4.948 13.0538 4.94656 13.1092 4.89116L15.2611 2.73922C15.3186 2.68167 15.3171 2.58847 15.2586 2.53187C13.6387 0.964752 11.4322 0 9.00037 0C8.81787 0 8.63682 0.006082 8.45703 0.0168046C10.6733 0.148816 12.6737 1.08231 14.1721 2.53187Z" fill="#E53935"/>
                        <path d="M15.6027 15.1163C13.9591 16.8898 11.6094 17.9999 9.00066 17.9999C5.47711 17.9999 2.42655 15.975 0.949219 13.0251L3.73973 11.1128C4.57711 13.1964 6.61722 14.6679 9.00066 14.6679C10.4964 14.6679 11.8567 14.0884 12.8694 13.1417L15.6027 15.1163Z" fill="#4CAF50"/>
                        <path d="M3.73888 11.1128L2.91602 11.6767C3.87173 13.4571 5.75114 14.6678 7.91327 14.6678C8.09612 14.6678 8.27686 14.6589 8.45527 14.642C6.30903 14.4374 4.51168 13.0358 3.73888 11.1128Z" fill="#43A047"/>
                        <path d="M9.00088 18.0001C11.6096 18.0001 13.9594 16.89 15.6029 15.1165L14.9334 14.6328C13.3902 16.5534 11.0752 17.8275 8.45898 17.9837C8.63828 17.9944 8.81891 18.0001 9.00088 18.0001Z" fill="#43A047"/>
                        <path d="M3.33198 9.00069C3.33198 9.74748 3.47648 10.4606 3.73906 11.1136L0.94851 13.0258C0.341541 11.8148 0 10.4476 0 9.00069C0 7.42345 0.40563 5.94106 1.11838 4.6521L3.8517 6.62703C3.51814 7.34881 3.33198 8.15322 3.33198 9.00069Z" fill="#FFC107"/>
                        <path d="M2.91683 11.6772L3.73969 11.1133C3.47711 10.4604 3.33262 9.74722 3.33262 9.00043C3.33262 8.15296 3.51877 7.34855 3.85233 6.62677L3.06325 6.05664C2.55085 6.90267 2.25347 7.89544 2.24623 8.96113C2.23955 9.94388 2.48307 10.8692 2.91683 11.6772Z" fill="#FFB300"/>
                        </svg>
                        Login with Google
                    </a>
                </div>
                <div class="or-divider">
                    <div class="divider line one-line">Or</div>
                </div>
                
                

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="password" class="col-form-label">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>

                    <div class="row justify-content-between align-items-center mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">


                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary active w-100">
                        {{ __('Login') }}
                    </button>



                </form>
            </div> 

            

            <h6 class="mt-2">Dont have an account yet? <a href="/register">New Account</a></h6>
        </div>

        <div class="col-12 col-md-6 sign-up-bg" style="height: 100vh;background-image:url('assets/img/legal/bg-auth-gradient.png');background-repeat: no-repeat;
    background-size: cover;
    background-position: top center;border-bottom-left-radius: 120px;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="sign-up-img">
                    <img  src="assets/img/legal/auth-bg.png" alt="legal logo" />
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
