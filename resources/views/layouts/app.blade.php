<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

     @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{--@vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
 </head>
<body>
    <div id="app">
       <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand me-3" href="{{ url('/') }}">
                        {{ config('app.name', 'TALLERRAPID') }}
                    </a>
                    @auth
                        <div class="d-flex flex-wrap gap-2">
                            @modulo('tickets')
                            <x-nav-card route="tickets.index" label="Tickets" />
                            @endmodulo
                            @modulo('items')
                                <x-nav-card route="items.index" label="Máquinas" />
                            @endmodulo
                            @modulo('parts')
                                <x-nav-card route="parts.index" label="Partes" />
                            @endmodulo
                            @modulo('providers')    
                                <x-nav-card route="providers.index" label="Proveedores" />
                            @endmodulo 
                            @modulo('sectors')    
                                <x-nav-card route="sectors.index" label="Secciones" />
                            @endmodulo    
                            
                            @modulo('states')    
                                <x-nav-card route="states.index" label="Estados" />
                            @endmodulo    
                            @modulo('positions')    
                                <x-nav-card route="positions.index" label="Oficios" />
                            @endmodulo
                            @modulo('users')    
                                <x-nav-card route="users.index" label="Usuarios" />
                            @endmodulo
                        </div>
                </div> <!-- cierre de div.d-flex (logo + menú) -->
                @endauth
                <div class="collapse navbar-collapse mt-2 mt-md-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div> <!-- cierre de .container -->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
</body>
</html>
                    
