<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1 class="modal-title text-center" id="myModalLabel"><?= date_format(date_create($schedule["day"]), "d-m-Y")?></h1>
</div>
<?=Form::open(['url' => 'schedule/delete', 'id'=>'delete'])?>
    <div class="modal-body">
        <table class="table">
            <tr>
                <td>Evento</td>
                <td><h5><?=$schedule['name']?><h5></td>
            </tr>
            <tr>
                <td>Local</td>
                <td><h6><?=$schedule->place->name?><h6></td>
            </tr>
            <tr>
                <td>Horário</td>
                <td><h6><?=date('H:i', strtotime($schedule['hour_start']))?> - <?=date('H:i', strtotime($schedule['hour_end']))?></td>
            </tr>
        </table>
        <?=Form::hidden('schedule[id]', $schedule['id'])?>
        <?=Form::hidden('referer', @$_SERVER['HTTP_REFERER'])?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                EXCLUIR
            </button>
            <div class="dropdown-menu">
                <button type="submit" class="btn btn-outline-danger dropdown-item text-center">SIM</button>
            </div>
        </div>
    </div>
<?=Form::close()?>
