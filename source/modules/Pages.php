<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Pages extends AppController {

    function date($month = null) {
        $month = $month == null ? date('Y-m') : $month;
        $month_raw = str_replace('-', '', $month);

        $first_day = date('w',strtotime("$month-01"));
        $last_day = date('t',strtotime($month));

        $this->view->month = $month;
        $this->view->today = date('Y-m-d');
        $this->view->first_day = $first_day;

        $this->view->days = [];
        for ($i=1-$first_day; $i <= $last_day; $i++) {
            $this->view->days[$i] = array();
        }
        $this->view->data['groups'] = model\Group::orderBy("name")->get();
        $this->view->data['schedules'] = model\Schedule::whereRaw("EXTRACT(YEAR_MONTH FROM day) = '$month_raw'")->orderBy("hour_start")->get();
        foreach ($this->view->data['schedules'] as $j=>$schedule) {
            $pos = date('d', strtotime($schedule->day))+0;
            array_push($this->view->days[$pos], $schedule);
        }

        $this->view->data['salas'] = model\Place::orderBy("name")->selectRaw("*,(SELECT count(id) FROM calendar.schedules WHERE EXTRACT(YEAR_MONTH FROM day) = '$month_raw' and places.id = place_id) as uso")->get();        
        $this->view->data['agendadas'] = model\Place::whereRaw("id in (SELECT place_id FROM schedules
				                                                        WHERE EXTRACT(YEAR_MONTH FROM day) = '$month_raw')")->orderBy("name")->get();

        $this->view->prev = HREF."pages/date/".date('Y-m', strtotime("-1 month", strtotime($month)));
        $this->view->next = HREF."pages/date/".date('Y-m', strtotime("+1 month", strtotime($month)));
        $this->render('pages/index', 'default');
    }
}
