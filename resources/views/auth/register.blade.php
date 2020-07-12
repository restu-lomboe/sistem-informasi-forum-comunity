<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Login Forum</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    @include('auth.style')
  </head>

  <body class="text-center">
    <form class="form-signin" action="{{ route('register') }}" method="POST">
        {{ csrf_field() }}
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h5 mb-5 font-weight-normal">Please register a new account</h1>

            <label for="inputEmail" class="sr-only">Your Name</label>
            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" placeholder="please input your nama ..." autofocus>
            @error('nama')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="inputEmail" class="sr-only">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="please input your email ...">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="inputPassword" class="sr-only">Password</label>
            <input id="password" type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="please input your password ...">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="inputPassword" class="sr-only">Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm your password ...">


            <button class="btn btn-lg btn-primary btn-block mt-5" type="submit">Sign Up</button>

            <a class="btn btn-link float-left" href="{{ url('/') }}">
                {{ __('Back To Home') }}
            </a>
            <a href="{{ route('login') }}" class="btn btn-link float-right">Sign In ??</a>
        <p class="mt-5 mb-3 text-muted">copyright &copy; <script>document.write(new Date().getFullYear());</script></p>
    </form>
  </body>
</html>
