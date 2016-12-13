<div class="wrapper">
    <div class="col-md-9">
        <div class="form-group">
            <?php $this->input('select', 'page[group]', 'class="form-control"', $this->data['groups'], false); ?>
        </div>
        <div class="calendar">
            <div class="calendar-header">
                <ul>
                    <li class="prev"><a href="<?=$this->prev?>">&#10094;</a></li>
                    <li><?=date('M Y', strtotime($this->month))?></li>
                    <li class="next"><a href="<?=$this->next?>">&#10095;</a></li>
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
                    ul.days > li:nth-child(-n+<?=$this->first_day?>) {
                        visibility: hidden;
                    }
                </style>
                <ul class="days">
                    <?php foreach ($this->days as $day=>$schedules) : ?>
                        <?php $full_day = $this->month."-".str_pad($day, 2, "0", STR_PAD_LEFT); ?>
                        <li <?= ($this->today == $full_day ? "class='today'" : "") ?>>
                            <?= ($day<=0? "." : $day) ?>
                            <?=$this->link("+", "schedules/add/$full_day", 'class="btn-add hidden-xs-down" data-toggle="modal" data-target="#modal_frame"')?>
                            <ul class="schedules">
                                <?php foreach ($schedules as $i=>$schedule) : ?>
                                    <li class="event" style="background-color:<?=$schedule->place->color?>">
                                        <?php $id=$schedule->id?>
                                        <?=$this->link(date('H:i', strtotime($schedule->hour_start)).' '.$schedule->name, 'schedules/edit/'.$schedule->id,
                                                        'class="" data-toggle="modal" data-target="#modal_frame" title="'.$schedule->name.'"')?>
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
        <h5>Salas</h5>
        <ul class="salas">
            <?php foreach ($this->data['salas'] as $i=>$sala) : ?>
                <li>
                    <span style="background-color: <?= ($sala->uso > 0) ? $sala->color : '#fafafa'?>"></span>
                    <?=$sala->name?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<?php $this->includes("modal_frame") ?>
<?php $this->scriptStart() ?>
<script type="text/javascript">
    $('#modal_frame').on('show.bs.modal', function (e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href')+'/'+$('#PageGroup').val());
    });
    $('#modal_frame').on('shown.bs.modal', function (e) {
        $("[type=time]").inputmask("99:99");
        $(".date").inputmask("99/99/9999");
        $(".date").focusout(function(e){
            $(e.target).next("input[type=hidden]").val(
                moment($(e.target).val(), ["DD/MM/YYYY", "YYYY-MM-DD"]).format('YYYY-MM-DD')
            );
        });

        $(".btn-save").click(function(){
            var place_id = $('#SchedulePlace_id').val();
            var dayStart = $('#ScheduleDay').val();
            var dayEnd = $('#ScheduleExtend_date').val() || dayStart;
            var hourStart = $('#ScheduleHour_start').val();
            var hourEnd = $('#ScheduleHour_end').val();
            var url = "<?=$this->href("schedules/check/")?>" + place_id +"/"+ dayStart +"/"+ dayEnd +"/"+ hourStart +"/"+ hourEnd;

            $.ajax(url).done(function(result){
                if (result.length == 0) {
                    $("#add").submit();
                } else {
                    $('.evento-list').html("");
                    $(".evento-count").text(result.length);
                    $(".evento-card").show();
                    $.each(result, function(i, o){
                        var evento = moment(o.day, "YYYY-MM-DD").format('DD') + ' - ' + o.name + ' (' + moment(o.hour_start, "LTS").format("HH:mm") +'-'+moment(o.hour_end, "LTS").format("HH:mm")+')';
                        $('.evento-list').append('<li>'+evento+'</li>');
                    });
                }
            });
        });
    });
</script>
<?php $this->scriptEnd() ?>
