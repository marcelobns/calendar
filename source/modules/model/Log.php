<?php
/**
* @author Marcelo Barbosa
* 2016-11-29
*/
namespace source\modules\model;

class Log extends \Anotherwise\Bonus\Model{

    protected $table = "log";
    protected $guarded = array();

    public function user() {
        return $this->BelongsTo('\source\modules\model\User');
    }
}
