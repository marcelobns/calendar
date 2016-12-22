@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form-horizontal form-login" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <div class="form-group text-muted">
            <h4>Login</h4>
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome" required autofocus>
            @if ($errors->has('name'))
                <small class="form-text text-muted">
                    {{ $errors->first('name') }}
                </small>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" placeholder="Senha" required>
            @if ($errors->has('password'))
                <small class="form-text text-muted">
                    {{ $errors->first('password') }}
                </small>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                ENTRAR
            </button>
            {{-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
                esqueceu a senha?
            </a> --}}
        </div>
    </form>
</div>
@endsection
