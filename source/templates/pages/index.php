<style media="screen">
    ul.days > li:nth-child(-n+<?=$this->first_day?>) {
        visibility: hidden;
    }
</style>
<div class="col-sm-12 header">

</div>
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
            <ul class="days">
                <?php foreach ($this->days as $day=>$schedules) : ?>
                    <?php $full_day = $this->month."-".str_pad($day, 2, "0", STR_PAD_LEFT); ?>
                    <li <?= ($this->today == $full_day ? "class='today'" : "") ?>>
                        <?= ($day<=0? "." : $day) ?>
                        <?=$this->link("+", "schedules/add/$full_day", 'class="btn-add hidden-md-down" data-toggle="modal" data-target="#modal_frame"')?>
                        <ul class="schedules">
                            <?php foreach ($schedules as $i=>$schedule) : ?>
                                <li class="event" style="background-color:<?=$schedule->place->color?>">
                                    <?php $id=$schedule->id?>
                                    <?=$this->link(date('h:i', strtotime($schedule->hour_start)).' '.$schedule->name, 'schedules/edit/'.$schedule->id,
                                                    'class="" data-toggle="modal" data-target="#modal_frame"')?>
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
                <?php if($sala->uso > 0) { ?>
                    <span style="background-color: <?=$sala->color?>"></span>
                <?php } else { ?>
                    <span></span>
                <?php } ?>
                <?=$sala->name?>
            </li>
        <?php endforeach ?>
    </ul>
</div>
<?php $this->includes("modal_frame") ?>
<?php $this->scriptStart() ?>
<script type="text/javascript">
    $('#modal_frame').on('show.bs.modal', function (e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href')+'/'+$('#PageGroup').val());
    });
    $('#modal_frame').on('shown.bs.modal', function (e) {
        $("[type=time]").inputmask("99:99");
        $("[type=date]").inputmask("99/99/9999");
    });
</script>
<?php $this->scriptEnd() ?>
