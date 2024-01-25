<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Employee</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>Employee</b>POS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        @if ($message = Session::get('success'))
        <div id="hide" class="alert alert-success d-flex align-items-center" role="alert">
          {{ $message }}
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div id="hide" class="alert alert-danger d-flex align-items-center" role="alert">
          {{ $message }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          @foreach ($errors->all() as $error)
          {{ $error }}
          @endforeach
        </div>
        @endif

        <form action="/" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="John Doe" required value="{{ old('username') }}" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="social-auth-links text-center mb-3">
            <button type="submit" class="btn btn-block btn-primary">
              Sign In
            </button>
          </div>
        </form>
        <!-- /.social-auth-links -->
        <p class="mb-0">
          <a href="/loginadmin" class="text-center">Sign in as admin</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('AdminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('AdminLTE')}}/dist/js/adminlte.min.js"></script>
</body>

</html>