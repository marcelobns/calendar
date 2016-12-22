<?=Form::open(['action' => 'GroupController@save'])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1 class="modal-title text-center" id="myModalLabel"></h1>
</div>
<div class="modal-body">
    <input type="hidden" name="group[id]" value="{{$group->id}}">
    <div class="form-group">
        <label for="GroupName">Nome</label>
        <input type="text" id="GroupName" class="form-control" name="group[name]" value="{{$group->name}}" required>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
    <button type="submit" class="btn btn-outline-primary">SALVAR</button>
</div>
<?=Form::close()?>
