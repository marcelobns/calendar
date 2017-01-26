{{Form::model($model, ['action' => 'GroupController@save'])}}
<div class="modal-header">
    <h1 class="modal-title text-center">Bloco</h1>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="GroupName">Nome</label>
        {{Form::hidden('group[id]', null)}}
        {{Form::text('group[name]', null, ['class'=>'form-control', 'required'])}}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
    <button type="submit" class="btn btn-outline-primary">SALVAR</button>
</div>
{{Form::close()}}
