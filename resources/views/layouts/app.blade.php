<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Calendário de Salas | DERCA</title>

    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">
    @stack('link')
</head>
<body>
    @section('before')
        <div class="navbar navbar-light bg-faded">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-7">
                        <a class="navbar-brand" href="{{ url('/') }}">Calendário das Salas</a>
                    </div>
                    @if (Auth::guest())
                    <div class="col-sm-4 col-5">
                        <ul class="nav justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-sign-in fa-lg"></i> Entrar</a>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="col-sm-4">
                        <ul class="nav justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" >Arquivo</a>
                                <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                                    <a class="dropdown-item" href="{{url("/")}}">Gerenciar Calendário</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('dashboard/groups')}}">Blocos</a>
                                    <a class="dropdown-item" href="{{url('dashboard/places')}}">Salas</a>
                                    <a class="dropdown-item" href="{{url('dashboard/users')}}">Usuários</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link uppercase" href="#">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    SAIR <i class="fa fa-sign-out"></i>
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @show

    <div class="container wrapper">
        @yield('content')
    </div>

    @section('after')

    @show

    <script charset="utf-8" src="{{asset('public/js/jquery.min.js')}}" ></script>
    <script charset="utf-8" src="{{asset('public/js/jquery.inputmask.bundle.js')}}" ></script>
    <script charset="utf-8" src="{{asset('public/js/tether.min.js')}}" ></script>
    <script charset="utf-8" src="{{asset('public/js/bootstrap.min.js')}}" ></script>
    <script charset="utf-8" src="{{asset('public/js/moment.js')}}" ></script>
    <script charset="utf-8" src="{{asset('public/js/selectize.min.js')}}" ></script>
    <script charset="utf-8" src="{{asset('public/js/custom.js')}}" ></script>
    @stack('script')
</body>
</html>
