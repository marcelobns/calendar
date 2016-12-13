<?php
/**
* @author Marcelo Barbosa
* 2016-11-29
*/
namespace source\modules\model;

class Schedule extends \Anotherwise\Bonus\Model{

    protected $table = "schedules";
    protected $guarded = array('extend_date', 'sabado', 'domingo');

    public function place() {
        return $this->BelongsTo('\source\modules\model\Place');
    }
}
