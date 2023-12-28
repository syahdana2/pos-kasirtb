<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>

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
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="/loginadmin" class="h1"><b>Admin</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <!-- @if(session()->has('loginError'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          {{ session('loginError') }}
        </div>
        @endif -->
        @if ($message = Session::get('success'))
          <div class="alert alert-success d-flex align-items-center" role="alert">
            {{ $message }}
          </div>
        @endif
        @if ($message = Session::get('error'))
          <div class="alert alert-danger d-flex align-items-center" role="alert">
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

        <form action="/loginadmin" method="post">
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
          <div class="social-auth-links text-center mt-2 mb-3">
            <button type="submit" class="btn btn-block btn-primary">Sign In</button>
          </div>
          <!-- /.col -->
        </form>
        <p class="mb-0">
          <a href="/" class="text-center">Sign in as employee</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
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