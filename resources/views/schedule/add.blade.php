<?=Form::open(['url' => '/schedule/save', 'id'=>'add'])?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h1 class="modal-title text-center" id="myModalLabel"><?= date_format(date_create($schedule["day"]), "d-m-Y")?></h1>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?=Form::hidden('referer', @$_SERVER['HTTP_REFERER'])?>
            <?=Form::hidden('schedule[day]', $schedule["day"], ['id'=>'ScheduleDay'])?>
        </div>
        <div class="form-group">
            <?=Form::select('schedule[place_id]', $places, null, ['id'=>'SchedulePlaceId', 'class'=>'form-control']);?>
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
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
             <div class="card-header" role="tab" id="headingThree">
               <h5 class="mb-0">
                 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                   Repetir Evento
                 </a>
               </h5>
             </div>
             <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
               <div class="card-block">
                   <div class="form-group">
                       <label for="">Até</label>
                       <?=Form::date('schedule[extend_date]', null, ['id'=>'ScheduleExtendDate', 'class'=>"form-control date", 'placeholder'=>"dd/mm/aaaa"]); ?>
                       <input type="hidden" name="schedule[extend_date]">
                   </div>
                   <div class="form-group">
                       <label>
                           <?=Form::hidden('schedule[sabado]', 0); ?>
                           <?=Form::checkbox('schedule[sabado]', 1); ?>
                           Incluir Sábado
                       </label>
                   </div>
                   <div class="form-group">
                       <label>
                           <?=Form::hidden('schedule[domingo]', 0); ?>
                           <?=Form::checkbox('schedule[domingo]', 1); ?>
                           Incluir Domingo
                       </label>
                   </div>
               </div>
             </div>
           </div>
           <div class="card evento-card">
            <div class="card-header" role="tab" id="headingTwo">
              <h5 class="mb-0">
                <a class="collapsed text-danger" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <span class="evento-count"></span> Evento(s) no período!
                </a>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="card-block">
                <ul class="evento-list">

                </ul>
              </div>
            </div>
          </div>
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
