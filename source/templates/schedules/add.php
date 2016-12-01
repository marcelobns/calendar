<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title text-center" id="myModalLabel">Agendar</h4>
</div>
<form class="" action="index.html" method="post">
    <div class="modal-body">
        <div class="form-group">
            <?php $this->input('select', 'schedule[place_id]', 'class="form-control"', $this->data['places'], false); ?>
        </div>
        <div class="form-group">
            <?php $this->input('text', 'schedule[day]', 'class="form-control" placeholder="Dia | dd/mm/aaaa"'); ?>
        </div>
        <div class="form-group">
            <?php $this->input('text', 'schedule[hour_start]', 'class="form-control" placeholder="Início | hh:mm"'); ?>
        </div>
        <div class="form-group">
            <?php $this->input('text', 'schedule[hour_end]', 'class="form-control" placeholder="Fim | hh:mm"'); ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block">SALVAR</button>
    </div>
</form>
