<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends AppModel {
    protected $table = "groups";
    protected $guarded = array('id');
}
