<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/reset.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/site.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('components/button.min.css') }}">
    @yield('imports')
  </head>
  <body>
    @include('templates.nav.base')
    <br>
    <br>
    <br>
    <div class="ui three column centered row stackable relaxed grid container">
      <div class="four wide column">
          @include('templates.nav.vabase')
      </div>
      <div class="eight wide column">
        <div class="row">
          @include('templates.alert.alert')
        </div>
        <br>
        <div class="row">
          @yield('content')
        </div>
      </div>
      <div class="four wide column">
      </div>
    </div>
    <script src="{{ asset('js/semantic.min.js') }}" charset="utf-8"></script>
  </body>
</html>
