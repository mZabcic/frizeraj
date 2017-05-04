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
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
 <nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
      <a class="nav-item">
        <img src="http://bulma.io/images/bulma-logo.png" alt="Bulma logo">
      </a>
      <a class="nav-item is-tab is-hidden-mobile is-active">Home</a>
      <a class="nav-item is-tab is-hidden-mobile">Features</a>
      <a class="nav-item is-tab is-hidden-mobile">Pricing</a>
      <a class="nav-item is-tab is-hidden-mobile">About</a>
    </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <div class="nav-right nav-menu">
      <a class="nav-item is-tab is-hidden-tablet is-active">Home</a>
      <a class="nav-item is-tab is-hidden-tablet">Features</a>
      <a class="nav-item is-tab is-hidden-tablet">Pricing</a>
      <a class="nav-item is-tab is-hidden-tablet">About</a>
    @if (Auth::guest())
                            <a class="nav-item is-tab" href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
        @else
      <a class="nav-item is-tab">
        <figure class="image is-16x16" style="margin-right: 8px;">
          <img src="http://bulma.io/images/jgthms.png">
        </figure>
        Profile
      </a>
      <a class="nav-item is-tab">Log out</a>
    </div>
    @endif
  </div>
</nav>
 <div id="app" class="main-content">
    <div class="container is-fluid">
        @yield('content')
        </div>
  </div>
  <footer class="footer__wrapper">
  <div class="content has-text-centered footer__container">
      <p>
        <a href="https://github.com/mZabcic/frizeraj"><b>Frizeraj</b></a> by Nikad Skupa. The source code is licensed
        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. 
      </p>
  </div>
</footer>
        
        
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
      
</body>
</html>
