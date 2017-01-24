<div class="calendar">
    <div class="calendar-header">
        <ul>
            <li></li>
            <li>{{$place->name}}</li>
            <li></li>
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
                    @if (!Auth::guest())
                        <input id="day-{{$weekday}}" type="checkbox" name="" value="{{$weekday}}" class="place-select"><label for="day-{{$weekday}}" class="place-select-label"></label>
                        <a href="{{url("schedule/add_weekday/{$place->id}/{$weekday}")}}" class="btn-add hidden-xs-down" data-toggle="modal" data-target="#modal_frame">+</a>
                    @endif

                    <ul class="schedules events">
                        @foreach ($schedules as $key=>$schedule)
                            <li class="event" style="background-color:<?=$schedule->place->color?>">
                                <?php $id=$schedule->id ?>
                                @if (!Auth::guest())
                                    <a href="{{url("schedule/edit/{$schedule->id}")}}" data-toggle="modal" data-target="#modal_frame" title="<?=$schedule->name?>">
                                        <?=date('H:i', strtotime($schedule->hour_start)).' '.$schedule->name?>
                                    </a>
                                @else
                                    <a href="#" title="<?=$schedule->name?>">
                                        <?=date('H:i', strtotime($schedule->hour_start)).' '.$schedule->name?>
                                    </a>
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@push('script')
    <script type="text/javascript">
    var weekdays;
    $('#modal_frame').on('show.bs.modal', function(e) {
        weekdays = [];
        $('.place-select:checked').each(function(i, o){
            weekdays[i] = o.value;
        });
        $(this).find('.modal-content').load(e.relatedTarget.href);
    });
    $('#modal_frame').on('shown.bs.modal', function(e) {
        $("#ScheduleWeekDays").val(weekdays);
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
