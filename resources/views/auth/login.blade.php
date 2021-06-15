<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('auth/fonts/icomoon/style.css') }}">

  <link rel="stylesheet" href="{{ asset('auth/css/owl.carousel.min.css') }}">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}">

  <!-- Style -->
  <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">

  <title>Barcode Radja</title>
</head>
<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('webdev.png') }}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">Login to aplication barcode.</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group first">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror

              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn  btn-primary">
              <a href="{{ route('register')}}" ><input value="Register" class="btn  btn-danger"></a>

            </form>
          </div>
        </div>
      </div>
    </div>


  </div>



  <script src="{{ asset('auth/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('auth/js/popper.min.js') }}"></script>
  <script src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('auth/js/main.js') }}"></script>
</body>
</html>