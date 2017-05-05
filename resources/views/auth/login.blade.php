<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    @yield('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @yield('scripts')
</head>
<body>
 <nav class="nav has-shadow">
    <div class="nav-left">
      <a class="nav-item" href="/">
        <img src="./img/logo.png" alt="Logo">
      </a>
      <a class="nav-item is-tab is-hidden-mobile" href="/">Naslovna</a>
      <a class="nav-item is-tab is-hidden-mobile">Cjenik</a>
     <a class="nav-item is-tab is-hidden-mobile">O nama</a>
    </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <div class="nav-right nav-menu">
      <a class="nav-item is-tab is-hidden-tablet">Naslovna</a>
      <a class="nav-item is-tab is-hidden-tablet">Cjenik</a>
      <a class="nav-item is-tab is-hidden-tablet">O nama</a>
    @if (Auth::guest())
                            <a class="nav-item is-tab" href="/login">Prijava</a>
                            <a class="nav-item is-tab" href="/register">Registracija</a>
        @else
             <a class="nav-item is-tab" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
        @endif


</nav>
 <div id="app" class="main-content">
    <div class="container is-fluid">
        @yield('content')
        </div>
  </div>
  <footer class="footer-wrapper">
  <div class="content has-text-centered footer-container">
      <p>
        <a href="https://github.com/mZabcic/frizeraj"><b>Frizeraj</b></a> by Nikad Skupa. The source code is licensed
        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
      </p>
  </div>
</footer>


@if(session()->has('message'))
    <input id="notification" type="hidden" value="{{ session()->get('message') }}"/>
@endif

    <!-- Scripts -->

    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>
