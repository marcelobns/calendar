<div class="calendar">
    <div class="calendar-header">
        <ul>
            <li class="prev"><a href="{{$prev}}">&#10094;</a></li>
            <li>{{date('M Y', strtotime($month))}}</li>
            <li class="next"><a href="{{$next}}">&#10095;</a></li>
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
        ul.days > li:nth-child(-n+{{$first_day}}) {
            visibility: hidden;
        }
        </style>
        <ul class="days">
            @foreach ($days as $day=>$schedules)
                <li {{($day == date('Y-m-d') ? "class=today" : "")}}> {{date('d', strtotime($day))}}
                    @if (!Auth::guest())
                        <a href="{{url("schedule/add/$day/$group_id")}}" class="btn-add hidden-xs-down" data-toggle="modal" data-target="#modal_frame">+</a>
                    @endif
                    <ul class="schedules">
                        @foreach ($schedules as $i=>$schedule)
                            <li class="event" style="background-color:{{$schedule->place->color}}">
                                <a href="{{url("schedule/edit/{$schedule->id}")}}" title="{{$schedule->name}}" data-toggle="modal" data-target="#modal_frame" >
                                    {{date('H:i', strtotime($schedule->hour_start)).' '.$schedule->name}}
                                </a>
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
    $('#modal_frame').on('show.bs.modal', function(e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href'));
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
                var url = "{{url("schedule/check")}}/" + placeId +"/"+ dayStart +"/"+ dayEnd +"/"+ hourStart +"/"+ hourEnd;

                $.ajax(url).done(function(result){
                    result = JSON.parse(result);
                    if (result.length == 0) {
                        $("#add").submit();
                    } else {
                        $('.evento-list').html("");
                        $(".evento-count").text(result.length);
                        $(".evento-card").show();
                        $.each(result, function(i, o){
                            var day = (o.day == null) ? weekday(o.weekday) : moment(o.day, "YYYY-MM-DD").format('DD/MM');
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
