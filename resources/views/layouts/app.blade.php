<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link rel="shortcut icon" href="./icon/superstor-favicon.png">

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
     
  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
