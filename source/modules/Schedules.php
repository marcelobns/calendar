<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Schedules extends AppController {
    function add($day = null, $group = null){
        $this->view->data['places'] = model\Place::where("group_id", $group)->orderBy("name")->get();
        $this->view->data['schedule']['day'] = $day;

        $this->render('schedules/add', 'none');
    }
}
