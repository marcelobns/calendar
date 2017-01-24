<?=Form::open(['action' => 'PlaceController@save'])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1 class="modal-title text-center" id="myModalLabel"></h1>
</div>
<div class="modal-body">
    <input type="hidden" name="place[id]" value="{{$place->id}}">
    <div class="form-group">
        <label for="PlaceGroup">Bloco</label>
        <?=Form::select("place[group_id]", $groups, $place->group_id, ["id"=>"PlaceGroup", "class"=>"form-control", "required"])?>
    </div>
    <div class="form-group">
        <label for="PlaceName">Nome da Sala</label>
        <?=Form::text("place[name]", $place->name, ["id"=>"PlaceName", "class"=>"form-control uppercase", "required", "autofocus"])?>
    </div>
    <div class="form-group">
        <label for="PlaceColor">Cor</label>
        <?=Form::color("place[color]", $place->color, ["id"=>"PlaceColorPicker"])?>
        <?=Form::text("place[color]", $place->color, ["id"=>"PlaceColor", "required"])?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
    <button type="submit" class="btn btn-outline-primary">SALVAR</button>
</div>
<?=Form::close()?>
