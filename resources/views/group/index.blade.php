@extends('layouts.app')
@section('content')
    <div class="container index">
        <h2>Blocos</h2>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">
                        <a href="{{url('group')}}" data-toggle="modal" data-target="#modal_frame"><i class="fa fa-file-o"></i> Novo Bloco</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $i => $group)
                    <tr>
                        <td contenteditable="true">{{$group->id}}</td>
                        <td>{{$group->name}}</td>
                        <td class="text-center">
                            <a href="{{url("group/{$group->id}")}}" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal_frame" title="Editar">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="" class="btn btn-outline-danger btn-sm" title="Excluir">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@include('partial.modal_frame')

@push('script')
<script type="text/javascript">
    $('#modal_frame').on('show.bs.modal', function(e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href'));
    });
</script>
@endpush
