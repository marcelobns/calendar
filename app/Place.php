<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends AppModel {
    protected $table = "places";
    protected $guarded = array('id');

    public function group() {
        return $this->BelongsTo('App\Group');
    }
    public function schedules() {
        return $this->HasMany('App\Schedule');
    }
}
