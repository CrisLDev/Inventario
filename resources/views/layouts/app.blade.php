<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/62c480e0b6.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/contactanos"><i class="fas fa-id-card"></i> Contactanos</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/home"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            </li>
                            @can('items.index')
                            <li class="nav-item">
                                <a class="nav-link" href="/items"><i class="fas fa-sitemap"></i> Items</a>
                            </li> 
                            @endcan
                            @can('cursos.index')
                                <li class="nav-item">
                                    <a class="nav-link" href="/cursos"><i class="fab fa-wpforms"></i> Cursos</a>
                                </li>
                            @endcan
                            @can('users.index')
                            <li class="nav-item">
                                <a class="nav-link" href="/users"><i class="fab fa-wpforms"></i> Usuarios</a>
                            </li>
                            @endcan
                            @can('roles.index')
                            <li class="nav-item">
                                <a class="nav-link" href="/roles"><i class="fab fa-wpforms"></i> Roles</a>
                            </li>
                            @endcan
                            @can('notieneperfil')
                            <li class="nav-item">
                                <a class="nav-link" href="/perfiles/todo"><i class="fab fa-wpforms"></i> Perfiles</a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="/contactanos"><i class="fas fa-id-card"></i> Contactanos</a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-registered"></i> {{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @can('isadmin')
                                    <a class="dropdown-item" href="/admin">Administración</a>
                                    @endcan
                                    
                                    <a class="dropdown-item" href="/perfil">Perfil</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container mt-0 pt-0 mensajes">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if ( session('mensaje') )
                <div class="alert alert-success">{{ session('mensaje') }}</div>
                @endif
                @if ( session('erroresc') )
                <div class="alert alert-danger">{{ session('erroresc') }}</div>
                @endif
                @if ($errors->any())
              <div class="alert alert-danger mb-0 mt-0">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div><br />
                @endif
            </div>
            @yield('content')
        </main>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".mensajes").fadeTo(2000, 500).slideUp(500, function() {
            $(".mensajes").slideUp(500);
            });
        });
    </script>
    @yield('scripts')
    
</body>
</html>