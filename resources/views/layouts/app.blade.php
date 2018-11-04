<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link rel="shortcut icon" href="/icon/superstor-favicon.png">

  <title>{{ config('app.name', 'SUPERSTORE') }}</title>

  <!-- Styles -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
  <!-- Main Wrapper Start Here -->
    <div class="wrapper">
      @include('layouts.partials.header')
      @yield('content')
      @include('layouts.partials.footer')
    </div>
  <!-- Main Wrapper End Here -->

  <!-- modal-login-end -->
  <div class="modal fade" id="modal-login" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="index.html" method="post">
            <div class="form-group">
              <label class="label-form" for="email">Email</label>
              <input class="form-control auth" type="text" name="email" value="" placeholder="example@gmail.com">
            </div>
            <div class="form-group">
              <label class="label-form" for="username">Password</label>
              <input class="form-control auth" type="password" name="password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <div class="form-group forgot-password">
              <a href="forgot-password.html">Forgot Password</a>
            </div>
            <input class="btn btn-info btn-lg" type="submit" name="login" value="Login">
            <div class="form-group caption-after-submit">
              Not a member yet? <a href="#">Register</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- modal-login-end -->
  <!-- modal-register-end -->
  <div class="modal fade" id="modal-register" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Register</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="index.html" method="post">
            <div class="form-group">
              <label class="label-form" for="name">Name</label>
              <input class="form-control auth" type="text" name="name" value="" placeholder="Type your name">
            </div>
            <div class="form-group">
              <label class="label-form" for="email">Email</label>
              <input class="form-control auth" type="email" name="email" value="" placeholder="example@gmail.com">
            </div>
            <div class="form-group">
              <label class="label-form" for="phone">Phone</label>
              <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
            </div>
            <div class="form-group">
              <label class="label-form" for="password">Password</label>
              <input class="form-control auth" type="password" name="password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <div class="form-group">
              <label class="label-form" for="retype-password">Re Type Password</label>
              <input class="form-control auth" type="password" name="retype-password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <input class="btn btn-info btn-lg" type="submit" name="register" value="Register">
            <div class="form-group caption-after-submit">
              Already have an account? <a href="#">Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- modal-register-end -->
  <!-- modal-change-password-start -->
<div class="modal fade" id="modal-change-password" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label class="label-form" for="email">Type Old Password</label>
                        <input class="form-control auth" type="password" name="old-password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="username">Type New Password</label>
                        <input class="form-control auth" type="password" name="new-password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="username">Re Type New Password</label>
                        <input class="form-control auth" type="password" name="retypenew-password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    </div>
                    <input class="btn btn-info btn-lg" type="submit" name="submit" value="SAVE">
                </form>
            </div>
            <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>
</div>
</div>
<!-- modal-change-password-end -->
<!-- modal-edit-profile-start -->
<div class="modal fade" id="modal-edit-profile" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="modal-title">Edit Profile</p>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label class="label-form" for="name">First Name</label>
                        <input class="form-control auth" type="text" name="first-name" value="" placeholder="Type your name">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="name">Last Name</label>
                        <input class="form-control auth" type="text" name="last-name" value="" placeholder="Type your name">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="email">Email</label>
                        <input class="form-control auth" type="text" name="email" value="" placeholder="example@gmail.com">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="phone">Phone</label>
                        <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="gender[]">Gender</label><br>
                        <input class="form-control auth" type="radio" name="gender[]" value="0">
                        <span class="gender-title">Male</span>
                        <input class="form-control auth" type="radio" name="gender[]" value="1">
                        <span class="gender-title">Female</span>
                    </div>
                    <input class="btn btn-info btn-lg" type="submit" name="submit" value="SAVE">
                </form>
            </div>
            <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>
</div>
</div>
<!-- modal-edit-profile-end -->
<!-- modal-add-new-address-end -->
<div class="modal fade" id="modal-add-new-address" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="modal-title">Add New Address</p>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label class="label-form" for="receiver-name">Receiver Name</label>
                        <input class="form-control auth" type="text" name="receiver-name" value="" placeholder="Type your name">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="phone">Phone</label>
                        <input class="form-control auth" type="text" name="phone" value="" placeholder="+6281908xxxx">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="city-distinct">City or Distinct</label>
                        <input class="form-control auth" type="text" name="city-distinct" value="" placeholder="Search City or District">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="postal-code">Postal Code</label>
                        <input class="form-control auth" type="text" name="postal-code" value="" placeholder="Type your postal Code">
                    </div>
                    <div class="form-group">
                        <label class="label-form" for="address">Address</label>
                        <textarea class="form-control auth" name="address" rows="8" cols="80"></textarea>
                    </div>
                    <input class="btn btn-info btn-lg" type="submit" name="submit" value="SAVE">
                </form>
            </div>
            <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
    </div>
</div>
</div>
<!-- modal-add-new-address-end -->
     
  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
