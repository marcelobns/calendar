<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Pages extends AppController {

    function index() {
        $month = '2016-11';
        $first_day = date('w',strtotime("$month-01"));
        $last_day = date('t',strtotime($month));
        $this->view->days = [];

        for ($i=1-$first_day; $i <= $last_day; $i++) {
            array_push($this->view->days, $i);
        }

        $this->view->month = $month;
        $this->view->today = date('Y-m-d');
        $this->view->first_day = $first_day;

        $this->view->data['groups'] = model\Group::orderBy("name")->get();
        //TODO sanitize parameters
        $this->view->data['livres'] = model\Place::whereRaw("id not in (SELECT place_id FROM schedules
				                                              WHERE EXTRACT(YEAR_MONTH FROM datetime) = '201611')")->get();

        $this->render('pages/index', 'default');
    }
    function schedules($begin = null){
        if(!$begin) {
            $this->view->data['schedules'] = model\Schedule::orderBy('datetime')->get();
        } else {
            //TODO utilizar parametro para a consulta
            $this->view->data['schedules'] = model\Schedule::orderBy('datetime')->get();
        }
    }
}
