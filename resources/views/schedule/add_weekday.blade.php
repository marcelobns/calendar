<?=Form::open(['url' => '/schedule/save_weekday', 'id'=>'add'])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1 class="modal-title text-center" id="myModalLabel">{{$schedule["weekday_name"]}}</h1>
</div>
<div class="modal-body">
    <div class="form-group">
        <?=Form::hidden('schedule[place_id]', $schedule["place_id"], ['id'=>'SchedulePlaceID']);?>
        <?=Form::hidden('schedule[weekday]', $schedule["weekday"], ['id'=>'ScheduleWeekDay']);?>
    </div>
    <div class="form-group">
        <label for="ScheduleYearSeq">Ano Letivo</label>
        <?=Form::text('schedule[year_seq]', $schedule["year_seq"], ['id'=>'ScheduleYearSeq', 'placeholder'=>'aaaa.n', 'class'=>'form-control', 'required']); ?>
    </div>
    <div class="form-group">
        <?=Form::text('schedule[name]', null, ['placeholder'=>'Evento', 'class'=>'form-control', 'required']); ?>
    </div>
    <div class="form-group">
        <?=Form::time('schedule[hour_start]', null, ['id'=>'ScheduleHourStart', 'class'=>"form-control", 'placeholder'=>"hh:mm | Início", 'required']); ?>
    </div>
    <div class="form-group">
        <?=Form::time('schedule[hour_end]', null, ['id'=>'ScheduleHourEnd', 'class'=>"form-control", 'placeholder'=>"hh:mm | Fim", 'required']); ?>
    </div>
</div>
<div class="modal-footer">
    <div class="col-xs-10 text-center">
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Atenção</strong> ao preencha os campos!
        </div>
    </div>
    <div class="col-xs-2">
        <button type="button" class="btn btn-save">+</button>
    </div>
</div>
<?=Form::close()?>
