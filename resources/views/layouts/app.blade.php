<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Calendário de Salas | DERCA</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/calendar.css">
    @stack('link')
</head>
<body>
    @section('before')
        <nav class="navbar navbar-light bg-faded">
            <a class="navbar-brand" href="{{ url('/') }}">Calendário de Salas</a>
            <ul class="nav navbar-nav">
                <div class="float-xs-right">
                    @if (Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Login <i class="fa fa-sign-in"></i></a>
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{ url('/register') }}">Register</a> --}}
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Arquivo</a>
                            <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                                <a class="dropdown-item" href="{{url('/')}}">Próximos Eventos</a>
                                <?php $month = date('Y-m')?>
                                <a class="dropdown-item" href="{{url("dashboard/{$month}/1")}}">Gerenciar Calendário</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('dashboard/groups')}}">Blocos</a>
                                <a class="dropdown-item" href="{{url('dashboard/places')}}">Salas</a>
                                <a class="dropdown-item" href="{{url('dashboard/users')}}">Usuários</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                SAIR
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </div>
            </ul>
            <div class="nav navbar-nav">

            </div>
        </nav>
    @show

    @yield('content')

    @section('after')

    @show

    <script charset="utf-8" src="/js/jquery.min.js" ></script>
    <script charset="utf-8" src="/js/jquery.inputmask.bundle.js" ></script>
    <script charset="utf-8" src="/js/tether.min.js" ></script>
    <script charset="utf-8" src="/js/bootstrap.min.js" ></script>
    <script charset="utf-8" src="/js/moment.js" ></script>
    <script charset="utf-8" src="/js/app.js" ></script>

    @stack('script')
</body>
</html>
