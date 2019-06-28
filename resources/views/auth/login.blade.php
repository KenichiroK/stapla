<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main__container">
        <div class="main__container__wrapper">
            <!--main__container__wrapperに記述していく-->
            <div class="left-area">
                <h1 class="left-area__title">Impro</h1>
            </div>
            <div class="right-area">

            <form method="POST" action="{{ route('login') }}">
                        @csrf
                <div class="right-area__box">
                    <p class="right-area__box__text">Welcome back! Please login to your account.</p>
                    <div class="user-name-container">
                        <p>User Name</p>
                        <input id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="password-container">
                        <p>Password</p>
                        <input id="password" type="password" class="input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="login-menu">
                        <div class="left-side">
                            <input class="check" type="checkbox"><span>Remember me</span>
                        </div>
                        <div class="right-side">
                            <p>Forgot Password</p>
                        </div>
                    </div>
                    <div class="btn-container">
                        <button type="submit" class="btn-container__login-btn button btn btn-primary">
                            {{ __('Login') }}
                        </button>
                            
                        <!-- <div @click="this.handleLogin" class="btn-container__login-btn button">Login</div> -->
                        <router-link to="/sign_up">
                            <div class="btn-container__sign-up-btn button">
                                Sign up
                            </div>
                        </router-link>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <p class ="policy">Term of use. Privacy policy</p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>