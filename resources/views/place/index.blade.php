@extends('layouts.app')
@section('content')
    <div class="container index">
        <h2>Salas</h2>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Nome</th>
                    <th>Bloco</th>
                    <th class="text-center">
                        <a href="{{url('place')}}" data-toggle="modal" data-target="#modal_frame"><i class="fa fa-file-o"></i> Nova Sala</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $i => $place)
                    <tr>
                        <td>{{$place->id}}</td>
                        <td><span class="sala-color" style="background-color:{{$place->color}}"></span></td>
                        <td>{{$place->name}}</td>
                        <td>{{$place->group->name}}</td>
                        <td class="text-center">                            
                            <a href="{{url("place/{$place->id}")}}" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal_frame" title="Editar">
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
    $('#modal_frame').on('shown.bs.modal', function(e) {
        $("#PlaceColorPicker").on('change', function(e){
            $("#PlaceColor").val(this.value);
        });
    });
</script>
@endpush
