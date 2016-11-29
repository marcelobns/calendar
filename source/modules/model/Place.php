<?php
/**
* @author Marcelo Barbosa
* 2016-11-29
*/
namespace source\modules\model;

class Place extends \Anotherwise\Bonus\Model{

    protected $table = "places";
    protected $guarded = array();

    public function group() {
        return $this->BelongsTo('\source\modules\model\Group');
    }
}
