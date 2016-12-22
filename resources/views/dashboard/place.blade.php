@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="col-md-9">
        <div class="calendar">
            <div class="calendar-header">
                <ul>
                    <li class="prev"><a href="{{url("dashboard/$month/{$place->group_id}")}}"> <i class="fa fa-calendar"></i> {{$place->group->name}}</a></li>
                    <li>{{$place->name}}</li>
                    <li class="next"></li>
                </ul>
            </div>
            <div class="calendar-body">
                <ul class="weekdays">
                    <li><span class="hidden-md-down">Domingo</span><span class="hidden-lg-up">Dom</span></li>
                    <li><span class="hidden-md-down">Segunda</span><span class="hidden-lg-up">Seg</span></li>
                    <li><span class="hidden-md-down">Terça</span><span class="hidden-lg-up">Ter</span></li>
                    <li><span class="hidden-md-down">Quarta</span><span class="hidden-lg-up">Qua</span></li>
                    <li><span class="hidden-md-down">Quinta</span><span class="hidden-lg-up">Qui</span></li>
                    <li><span class="hidden-md-down">Sexta</span><span class="hidden-lg-up">Sex</span></li>
                    <li><span class="hidden-md-down">Sábado</span><span class="hidden-lg-up">Sab</span></li>
                </ul>
                <ul class="days weekhour">
                    @foreach ($weekdays as $weekday => $schedules)
                    <li>
                        <a href="{{url("schedule/add_weekday/{$place->id}/{$weekday}")}}" class="btn-add hidden-xs-down" data-toggle="modal" data-target="#modal_frame">+</a>
                        <ul class="schedules events">
                            @foreach ($schedules as $key=>$schedule)
                                <li class="event" style="background-color:<?=$schedule->place->color?>">
                                    <?php $id=$schedule->id ?>
                                    <a href="/schedule/edit/<?=$schedule->id?>" data-toggle="modal" data-target="#modal_frame" title="<?=$schedule->name?>">
                                        <?=date('H:i', strtotime($schedule->hour_start)).' '.$schedule->name?>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="index">
            <h2>Eventos</h2>
            <?php foreach ($events as $i=>$schedule) : ?>
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
    <div class="col-md-3">
        <h5 class="text-head">SALAS</h5>
        <ul class="salas">
            <?php foreach ($salas as $i=>$sala) : ?>
                <li>
                    <a href="{{url("dashboard/place/{$sala->id}")}}">
                        <span style="background-color: <?= ($sala->uso > 0) ? $sala->color : '#fEfEfE'?>"></span>
                        <?=$sala->name?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
@endsection

@include('shared.modal_frame')

@push('script')
<script type="text/javascript">
    $('#modal_frame').on('show.bs.modal', function(e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href'));
    });
    $('#modal_frame').on('shown.bs.modal', function(e) {
        $("[type=time]").inputmask("99:99");
        $("#ScheduleYearSeq").inputmask("9999.9");
        $(".btn-save").click(function(){
            if($('#add')[0].checkValidity()){
                $("#add").submit();
            } else {
                $(".alert").show();
            }
        });
        $(".alert .close").click(function(){
            $(".alert").hide();
        });
    });
</script>
@endpush
