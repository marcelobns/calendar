@extends('layouts.app')
@section('content')
    {{Form::model($form, ['id'=>'FilterForm', 'action'=>'PageController@index','method'=>'get'])}}
    <div class="row">
        <div class="col-md-5 col-sm-6">
            {{Form::hidden('evento', 1, ['id'=>'evento-selectized'])}}
            <div class="form-group">
                <label for="">Bloco</label>
                {{Form::select('group_id', $groups, null, ['id'=>'group', 'class'=>'selectize', 'placeholder'=>'<Todos os Blocos>', 'required', 'title'=>'Selecione um bloco!'])}}
                <small id="group-help" class="form-text error">Selecione um Bloco!</small>
            </div>
        </div>
        <div class="col-md-7 col-sm-6">
            <div class="form-group">
                <label for="">Local</label>
                {{Form::select('place_id', $places, null, ['id'=>'place', 'class'=>'selectize', 'placeholder'=>'<Todas as Salas>', 'required'])}}
                <small id="place-help" class="form-text error">Selecione um Local!</small>
            </div>
        </div>
    </div>
    <div class="nav justify-content-center">
        <div class="form-group">
            <div class="btn-group" role="group" aria-label="...">
                <a href="#" class="submit btn btn-outline-primary {{(Input::get('calendar') == 'evento' || Input::get('calendar') == '') ? 'active' : ''}}" data-selector="evento" ><i class="fa fa-list"></i> Buscar</a>
                <a href="#" class="submit btn btn-outline-primary {{(Input::get('calendar') == 'group') ? 'active' : ''}}" data-selector="group" ><i class="fa fa-calendar"></i> MÊS</a>
                <a href="#" class="submit btn btn-outline-primary {{(Input::get('calendar') == 'place') ? 'active' : ''}}" data-selector="place" ><i class="fa fa-columns"></i> SEMANA</a>
            </div>
        </div>
    </div>
    {{Form::close()}}
    @if (Input::get('calendar') == 'group')
        @include('partial.pages_mes')
    @elseif (Input::get('calendar') == 'place')
        @include('partial.pages_semana')
    @else
        @include('partial.pages_eventos')
    @endif
@endsection

@include('partial.modal_frame')

@push('script')
<script type="text/javascript">
    $('.submit').on('click', function(e){
        var selector = $(e.currentTarget).data('selector');
        if($('#'+selector+'-selectized')[0].validity.valid){
            submit(selector);
        } else {
            $('#'+selector+'-help').show();
        }
    });
    $('.selectize').on('change', function(e){
        submit(e.currentTarget.id);
    });
    function submit(value){
        var input = $("<input>").attr("type", "hidden")
                                .attr("name", "calendar").val(value);
        $('#FilterForm').append($(input));
        $('#FilterForm').submit();
    }
</script>
@endpush
