@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="calendar-index">
            <div class="calendar-header">
                Eventos
            </div>
            <div class="calendar-nav">
                <div class="col-xs-10">

                </div>
                <div class="col-xs-2">
                    <div class="btn-gerenciar">
                        <button type="button" class="btn btn-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-calendar fa-2x"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php foreach ($groups as $i=>$group) : ?>
                                <a class="dropdown-item" href="{{url("dashboard/$month/{$group->id}")}}">{{$group->name}}</a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="calendar">
                <div class="calendar-body">
                    <?php foreach ($schedules as $i=>$schedule) : ?>
                        <div class="schedule">
                            <div class="col-xs-1 day" data-day="{{$schedule->day}}">
                                {{date('d/m', strtotime($schedule->day))}}
                            </div>
                            <div class="col-xs-11">
                                <span class="name">{{$schedule->name}}</span><br/>
                                <span class="details">{{date('H:i', strtotime($schedule->hour_start))}} - {{date('H:i', strtotime($schedule->hour_end))}} ({{$schedule->place->name}} | {{$schedule->place->group->name}})</span>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script type="text/javascript">
    var day;
    $('.day').each(function(i, o){
        if($(o).data('day') == day){
            $(o).css('visibility', 'hidden')
        }
        day = $(o).data('day');
    });
</script>
@endpush
