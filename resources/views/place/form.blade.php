{{Form::model($model, ['action' => 'PlaceController@save'])}}
<div class="modal-header">
    <h1 class="modal-title text-center">Salas</h1>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="PlaceGroup">Bloco</label>
        {{Form::hidden("place[id]", null)}}
        {{Form::select("place[group_id]", $groups, null, ["id"=>"PlaceGroup", "class"=>"form-control", "required"])}}
    </div>
    <div class="form-group">
        <label for="PlaceName">Nome da Sala</label>
        {{Form::text("place[name]", null, ["id"=>"PlaceName", "class"=>"form-control uppercase", "required", "autofocus"])}}
    </div>
    <div class="form-group">
        <label for="PlaceColor">Cor</label>
        {{Form::color("place[color]", null, ["id"=>"PlaceColorPicker"])}}
        {{Form::text("place[color]", null, ["id"=>"PlaceColor", "required"])}}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
    <button type="submit" class="btn btn-outline-primary">SALVAR</button>
</div>
{{Form::close()}}
