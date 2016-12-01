<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Pages extends AppController {

    function index($month = null) {
        $month = $month == null ? date('Y-m') : $month;
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
				                                                        WHERE EXTRACT(YEAR_MONTH FROM day) = '201611')")->orderBy("name")->get();

        $this->render('pages/index', 'default');
    }
}
