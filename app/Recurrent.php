<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurrent extends AppModel {
    protected $table = "recurrents";
    protected $guarded = array('id');
}
