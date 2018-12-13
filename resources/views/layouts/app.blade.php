<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="@yield('description')">

    <!-- Favicons -->
    <link rel="shortcut icon" href="/icon/superstor-favicon.png">

    <title>{{ env('APP_NAME', 'Supershop') }} @yield('title')</title>

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
                    <form name="login-form class="form-horizontal" action="{{ route('login') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label class="label-form" for="email">Email</label>
                            <input class="form-control auth" type="text" name="_email" value="" placeholder="example@gmail.com">
                            @if ($errors->has('_email'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('_email') }}</font></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="username">Password</label>
                            <input class="form-control auth" type="password" name="password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                            @if ($errors->has('password'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('password') }}</font></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group forgot-password">
                            <a href="{{ url('forgot-password') }}">Forgot Password</a>
                        </div>
                        <input class="btn btn-info btn-lg" type="submit" name="login" value="Login">
                        <div class="form-group caption-after-submit" data-toggle="modal" data-target="#modal-register" data-dismiss="modal">
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
                    <form class="form-horizontal" name="register-form" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="label-form" for="name">First Name</label>
                            <input class="form-control auth" type="text" name="_first_name" value="" placeholder="Type your first name" required>
                             @if ($errors->has('_first_name'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('_first_name') }}</font></strong>
                                </span>
                            @endif  
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="name">Last Name</label>
                            <input class="form-control auth" type="text" name="_last_name" value="" placeholder="Type your last name" required>
                             @if ($errors->has('_last_name'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('_last_name') }}</font></strong>
                                </span>
                            @endif  
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="email">Email</label>
                            <input class="form-control auth" type="email" name="_email" value="" placeholder="example@gmail.com" required>
                            @if ($errors->has('_email'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('_email') }}</font></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="phone">Phone</label>
                            <input class="form-control auth" type="number" name="phone" value="" placeholder="+6281908xxxx" required>                            
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="password">Password</label>
                            <input class="form-control auth" type="password" name="password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                            @if ($errors->has('password'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('password') }}</font></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="retype-password">Re Type Password</label>
                            <input class="form-control auth" type="password" name="password_confirmation" value=""
                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                        </div>
                        <input class="btn btn-info btn-lg" type="submit" name="register" value="Register">
                        <div class="form-group caption-after-submit data-toggle="modal" data-target="#modal-login" data-dismiss="modal">
                            Already have an account? <a href="#">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal-register-end -->
    <div class="modal fade" id="modal-register-success" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register Successs</h4>
          </div>
          <div class="modal-body">
            <p class="lead text-xs-center">Use your acount to login</p>
          </div>
          <div class="modal-footer">
                  :-)
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-update-profile-success" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Profile Successs</h4>
          </div>
          <div class="modal-body">
            <p class="lead text-xs-center">See your profile to see the changes</p>
          </div>
          <div class="modal-footer">
                  :-)
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
                    @if(Auth::check())
                        <form class="form-horizontal" action="{{ url('/') }}/users/change-password/{{ Auth::user()->id }}" method="post">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label class="label-form" for="email">Type Old Password</label>
                            <input class="form-control auth" type="password" name="old_password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                            @if ($errors->has('old_password'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('old_password') }}</font></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="username">Type New Password</label>
                            <input class="form-control auth" type="password" name="password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                            @if ($errors->has('password'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('password') }}</font></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label-form" for="username">Re Type New Password</label>
                            <input class="form-control auth" type="password" name="password_confirmation" value=""
                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                            @if ($errors->has('password_confirmation'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('password_confirmation') }}</font></strong>
                                </span>
                            @endif
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
    @if (Auth::check())     
    <!-- modal-edit-profile-start -->
    <div class="modal fade" id="modal-edit-profile" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title">Edit Profile</p>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url('/') }}/users/update-profile/{{ Auth::user()->id }}" method="post">
                    @csrf
                      <div class="form-group">
                          <label class="label-form" for="name">First Name</label>
                          <input class="form-control auth" type="text" name="first_name" value="{{ Auth::user()->_first_name }}" placeholder="Type your name">
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="name">Last Name</label>
                          <input class="form-control auth" type="text" name="last_name" value="{{ Auth::user()->_last_name }}" placeholder="Type your name">
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="email">Email (email can't change)</label>
                          <input class="form-control auth" type="text" name="email" value="{{ Auth::user()->_email }}" placeholder="example@gmail.com" readonly>
                          @if ($errors->has('email'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('email') }}</font></strong>
                                </span>
                            @endif
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="phone">Phone</label>
                          <input class="form-control auth" type="text" name="phone" value="{{ Auth::user()->_phone }}" placeholder="+6281908xxxx">
                            @if ($errors->has('phone'))
                                <span class="" role="alert">
                                    <strong><font color="red">{{ $errors->first('phone') }}</font></strong>
                                </span>
                            @endif
                      </div>
                      <div class="form-group">
                          <label class="label-form" for="gender[]">Gender</label><br>
                          <input class="form-control auth" type="radio" name="gender[]" value="GENDER01"  {{ Auth::user()->gender_id == "GENDER01"? 'checked' : '' }}>
                          <span class="gender-title">Male</span>
                          <input class="form-control auth" type="radio" name="gender[]" value="GENDER02" {{ Auth::user()->gender_id == "GENDER02"? 'checked' : '' }}>
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
@endif    
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
            </div>
        </div>
    </div>
    <!-- modal-add-new-address-end -->

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script>
        var URL = "{{ url('/') }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@if(Session::has('success_register'))
      <script type="text/javascript">
        $(document).ready(function(){
            $('#modal-register-success').modal('show');
        });
      </script>
@endif

@if(Session::has('success_update_profile'))
      <script type="text/javascript">
        $(document).ready(function(){
            $('#modal-update-profile-success').modal('show');
        });
      </script>
@endif

  @if (!$errors->isEmpty())
    @if (Session::get('last_modal') == "register")
      <script type="text/javascript">
        $(document).ready(function(){
            $('#modal-register').modal('show');
        });
      </script>
      @endif
    @if (Session::get('last_modal') == "login")
      <script type="text/javascript">
        $(document).ready(function(){
            $('#modal-login').modal('show');
        });
      </script>
      @endif
    @if (Session::get('last_modal') == "edit_profile")
      <script type="text/javascript">
        $(document).ready(function(){
            $('#modal-edit-profile').modal('show');
        });
      </script>
      @endif         
    @if (Session::get('last_modal') == "change_password")
    <script type="text/javascript">
      $(document).ready(function(){
            $('#modal-change-password').modal('show');
      });
    </script>
    @endif      
  @endif    
</body>

</html>