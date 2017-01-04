@extends('layouts.app')
@section('content')
    <div class="container index">
        <h2>Usuários</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">
                        <a href="{{url('user')}}" data-toggle="modal" data-target="#modal_frame"><i class="fa fa-file-o"></i> Novo Usuário</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td class="text-center">
                            <a href="{{url("user/{$user->id}")}}" title="Resetar senha" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal_frame">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" title="Desativar" class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-ban"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@include('shared.modal_frame')

@push('script')
    <script type="text/javascript">
    $('#modal_frame').on('show.bs.modal', function(e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href'));
    });
    $('#modal_frame').on('shown.bs.modal', function(e) {
        var password = $('#password');
        var password_confirm = $("#password_confirm");

        password_confirm.on('change', function(e){
            if(password.val() !== password_confirm.val()) {
                password_confirm[0].setCustomValidity("Senha não confere!");
            } else {
                password_confirm[0].setCustomValidity('');
            }
        });
    });
    </script>
@endpush
