<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    
</body>
</html>

    <main class="form-login">
        <div class="form">
            <div class="form__back">
                <div class="form__back--login">
                    <h3>Login {{ config('app.name', 'Laravel') }}</h3>
                    <button id="cta-login" class="btn">Log in </button>
                </div>
                <div class="form__back--register">
                    <h3>Register User</h3>
                    <button id="cta-register" class="btn">Register</button>
                </div>
            </div>
            <div class="form__front">
                <form method="POST" action="{{ route('login') }}" class="form form__front--login">
                    @csrf
                    <h2>Login</h2>
                    <input type="text" placeholder="Email" class="form-control  @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" required autocomplete="email">
                    <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('email')
                        <span class="invalid-feedback text-left mb-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('password')
                        <span class="invalid-feedback mb-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-outline-success d-block">Submit</button>
                </form>
                <form action="{{ route('register') }}" class="form form__front--register" method="POST">
                    @csrf
                    <h2>Register</h2>
                    <input type="text" placeholder="Full name" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="text" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="text" placeholder="Email confirm" class="form-control" name="email_confirmation" required autocomplete="email">
                    <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="password" placeholder="Password confirm" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                </form>
            </div>
        </div>
        
    </main>
    <script src="{{ asset('js/login.js') }}" defer></script>
</body>
</html>