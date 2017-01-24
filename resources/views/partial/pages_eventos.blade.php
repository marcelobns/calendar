{{Form::model($form, ['id'=>'SearchForm', 'action'=>'PageController@index','method'=>'get'])}}
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <div class="input-group">
              {{Form::input('search', 'search_text', null, ['id'=>'SearchText', 'class'=>'form-control', 'placeholder'=>'Buscar por Evento ou Responsável', 'required'])}}
              <span class="input-group-btn">
                  <button class="search btn btn-secondary"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}
@foreach ($schedules as $i=>$schedule)
<div class="schedule">
    <div class="col-12 day" data-day="{{$schedule->day}}">
        {{$schedule->dayDisplay}}
    </div>
    <div class="col-12">
        <span class="name">{{$schedule->name}}<span class="text-muted"> - {{$schedule->responsible}}</span></span><br/>
        <span class="details">{{date('H:i', strtotime($schedule->hour_start))}} - {{date('H:i', strtotime($schedule->hour_end))}} ({{$schedule->place->name}} | {{$schedule->place->group->name}})</span>
    </div>
</div>
@endforeach
