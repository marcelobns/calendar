<style media="screen">
    ul.days li:nth-child(-n+<?=$this->first_day?>) {
        visibility: hidden;
    }
</style>
<div class="col-sm-12 header">

</div>
<div class="col-sm-9">
    <div class="form-group">
        <?php $this->input('select', 'page[group]', 'class="form-control"', $this->data['groups'], false); ?>
    </div>
    <div class="calendar">
        <div class="calendar-header">
            <ul>
                <li class="prev"><a href="#">&#10094;</a></li>
                <li><?=date('M Y', strtotime($this->month))?></li>
                <li class="next"><a href="#">&#10095;</a></li>
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
                <?php foreach ($this->days as $i=>$day) : ?>
                    <?php $full_day = $this->month."-".str_pad($day, 2, "0", STR_PAD_LEFT); ?>
                    <li <?= ($this->today == $full_day ? "class='today'" : "") ?>>
                        <?= ($day<=0? "." : $day) ?>
                        <a href='schedules/add/<?=$full_day?>' class="btn-add hidden-md-down" data-toggle="modal" data-target="#modal_frame">+</a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
<div class="col-sm-3">
    <h5>Livres</h5>
    <ul class="salas">
        <?php foreach ($this->data['livres'] as $i=>$sala) : ?>
            <li><span style="background-color: <?=$sala->color?>"></span> <?=$sala->name?></li>
        <?php endforeach ?>
    </ul>
    <h5>Ocupadas</h5>
</div>
<?php $this->includes("modal_frame") ?>
<?php $this->scriptStart() ?>
<script type="text/javascript">
    $('#modal_frame').on('show.bs.modal', function (e) {
        $(this).find('.modal-content').load($(e.relatedTarget).attr('href')+'/'+$('#PageGroup').val());
    });
</script>
<?php $this->scriptEnd() ?>
