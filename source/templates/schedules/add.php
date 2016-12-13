<form id="add" method="post" action=<?=$this->href("schedules/add/save")?> >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h1 class="modal-title text-center" id="myModalLabel"><?= date_format(date_create($this->data["schedule"]["day"]), "d-m-Y")?></h1>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <?php $this->input('hidden', 'schedule[day]'); ?>
        </div>
        <div class="form-group">
            <?php $this->input('text', 'schedule[name]', 'placeholder="Evento" class="form-control" required'); ?>
        </div>
        <div class="form-group">
            <?php $this->input('select', 'schedule[place_id]', 'class="form-control"', $this->data['places'], false); ?>
        </div>
        <div class="form-group">
            <?php $this->input('time', 'schedule[hour_start]', 'class="form-control" placeholder="hh:mm | Início" required'); ?>
        </div>
        <div class="form-group">
            <?php $this->input('time', 'schedule[hour_end]', 'class="form-control" placeholder="hh:mm | Fim" required'); ?>
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
                       <?php $this->input('date', 'schedule[extend_date]', 'class="form-control date" placeholder="dd/mm/aaaa" '); ?>
                       <input type="hidden" name="schedule[extend_date]">
                   </div>
                   <div class="form-group">
                       <?php $this->input('checkbox', 'schedule[sabado]'); ?>
                       <label for="ScheduleSabado">Incluir Sábado</label>
                   </div>
                   <div class="form-group">
                       <?php $this->input('checkbox', 'schedule[domingo]'); ?>
                       <label for="ScheduleDomingo">Incluir Domingo</label>
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
        <button type="button" class="btn btn-save">+</button>
    </div>
</form>
