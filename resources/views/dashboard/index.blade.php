@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="col-md-9">
        <div class="form-group">
            <?=Form::select('page[group_id]', $groups, $group_id, ['id'=>'PageGroupId', 'class'=>'form-control'])?>
            <?=Form::hidden('page[month]', $month)?>
        </div>
        <div class="calendar">
            <div class="calendar-header">
                <ul>
                    <li class="prev"><a href="<?=$prev?>">&#10094;</a></li>
                    <li><?=date('M Y', strtotime($month))?></li>
                    <li class="next"><a href="<?=$next?>">&#10095;</a></li>
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
                <style media="screen">
                    ul.days > li:nth-child(-n+<?=$first_day?>) {
                        visibility: hidden;
                    }
                </style>
                <ul class="days">
                    <?php foreach ($days as $day=>$schedules) : ?>
                        <?php $full_day = $month."-".str_pad($day, 2, "0", STR_PAD_LEFT); ?>
                        <li <?= ($today == $full_day ? "class='today'" : "") ?>>
                            <?= ($day<=0? "." : $day) ?>
                            <a href="{{url("schedule/add/$full_day")}}" class="btn-add hidden-xs-down" data-toggle="modal" data-target="#modal_frame">+</a>
                            <ul class="schedules">
                                <?php foreach ($schedules as $i=>$schedule) : ?>
                                    <li class="event" style="background-color:<?=$schedule->place->color?>">
                                        <?php $id=$schedule->id?>
                                        <a href="{{url("schedule/edit/{$schedule->id}")}}" data-toggle="modal" data-target="#modal_frame" title="<?=$schedule->name?>">
                                            <?=date('H:i', strtotime($schedule->hour_start)).' '.$schedule->name?>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
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
    $('#PageGroupId').on('change', function(e){
        window.location.href = "<?=url('dashboard').'/'.$month?>/" + this.value;
    });
    $('#modal_frame').on('show.bs.modal', function(e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href')+'/'+$('#PageGroupId').val());
    });
    $('#modal_frame').on('shown.bs.modal', function(e) {
        $("[type=time]").inputmask("99:99");
        $(".date").inputmask("99/99/9999");
        $(".date").focusout(function(e){
            $(e.target).next("input[type=hidden]").val(
                moment($(e.target).val(), ["DD/MM/YYYY", "YYYY-MM-DD"]).format('YYYY-MM-DD')
            );
        });

        $(".btn-save").click(function(){
            if($('#add')[0].checkValidity()){
                var placeId = $('#SchedulePlaceId').val();
                var dayStart = $('#ScheduleDay').val();
                var dayEnd = $('#ScheduleExtendDate').val() || dayStart;
                var hourStart = $('#ScheduleHourStart').val();
                var hourEnd = $('#ScheduleHourEnd').val();
                var url = "/schedule/check/" + placeId +"/"+ dayStart +"/"+ dayEnd +"/"+ hourStart +"/"+ hourEnd;

                $.ajax(url).done(function(result){
                    if (result.length == 0) {
                        $("#add").submit();
                    } else {
                        $('.evento-list').html("");
                        $(".evento-count").text(result.length);
                        $(".evento-card").show();
                        $.each(result, function(i, o){
                            var day = o.day == null ? weekday(o.weekday) : moment(o.day, "YYYY-MM-DD").format('DD/MM');
                            var evento = day + ' - ' + o.name + ' (' + moment(o.hour_start, "LTS").format("HH:mm") +'-'+moment(o.hour_end, "LTS").format("HH:mm")+')';
                            $('.evento-list').append('<li>'+evento+'</li>');
                        });
                    }
                });
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
