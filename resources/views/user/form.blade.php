<?=Form::model($user, ['action' => 'UserController@save'])?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1 class="modal-title text-center" id="myModalLabel">Novo Usuário</h1>
</div>
<div class="modal-body">
    <?=Form::hidden('id')?>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <?=Form::text('name', null, ["class"=>"form-control", "name"=>"name", "placeholder"=>"Nome de usuário", "required"])?>
        @if ($errors->has('name'))
            <span class="help-block">
                {{ $errors->first('name') }}
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <?=Form::text('email', null, ["class"=>"form-control", "name"=>"email", "placeholder"=>"E-mail", "required"])?>
        @if ($errors->has('email'))
            <span class="help-block">
                {{ $errors->first('email') }}
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <?=Form::password('password', ["id"=>"password", "class"=>"form-control", "name"=>"password", "placeholder"=>"Senha", "required"])?>
        @if ($errors->has('password'))
            <span class="help-block">
                {{ $errors->first('password') }}
            </span>
        @endif
    </div>
    <div class="form-group">
        <?=Form::password('password_confirmation', ["id"=>"password_confirm", "class"=>"form-control", "name"=>"password_confirmation", "placeholder"=>"Confirmar senha", "required"])?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
    <button type="submit" class="btn btn-outline-primary">SALVAR</button>
</div>
<?=Form::close()?>
