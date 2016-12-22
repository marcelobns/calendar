<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends AppModel {
    protected $table = "schedules";
    protected $guarded = array('group', 'extend_date', 'month', 'sabado', 'domingo');

    public function place() {
        return $this->BelongsTo('App\Place');
    }
}
