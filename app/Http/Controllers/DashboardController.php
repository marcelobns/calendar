<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index($month = null, $group_id = null) {
        $month = $month == null ? date('Y-m') : $month;
        $month_raw = str_replace('-', '', $month);

        $first_day = date('w',strtotime("$month-01"));
        $last_day = date('t',strtotime($month));

        $view['month'] = $month;
        $view['group_id'] = $group_id;
        $view['today'] = date('Y-m-d');
        $view['first_day'] = $first_day;

        $view['days'] = [];
        for ($i=1-$first_day; $i <= $last_day; $i++) {
            $view['days'][$i] = array();
        }
        $view['groups'] = \App\Group::orderBy('name')->pluck('name', 'id');
        $view['schedules'] = \App\Schedule::whereRaw("EXTRACT(YEAR_MONTH FROM day) = '$month_raw' and place_id in (SELECT id FROM places WHERE group_id = $group_id)")->orderBy("hour_start")->orderBy("id")->get();
        foreach ($view['schedules'] as $j=>$schedule) {
            $pos = date('d', strtotime($schedule->day))+0;
            array_push($view['days'][$pos], $schedule);
        }
        $view['salas'] = \App\Place::where("group_id", $group_id)->orderBy("name")->selectRaw("*, (SELECT count(id) FROM schedules WHERE EXTRACT(YEAR_MONTH FROM day) = '$month_raw' and places.id = place_id) as uso")->get();

        $view['prev'] = url("dashboard/".date('Y-m', strtotime("-1 month", strtotime($month)))."/$group_id" );
        $view['next'] = url("dashboard/".date('Y-m', strtotime("+1 month", strtotime($month)))."/$group_id" );

        return view('dashboard/index', $view);
    }
    public function place($id = null){
        $view['month'] = date('Y-m');
        $view['place'] = \App\Place::find($id);
        $view['salas'] = \App\Place::where("group_id", $view['place']->group_id)->orderBy("name")->get();

        $view['weekdays'] = [];
        for ($i=0; $i <= 6; $i++) {
            $view['weekdays'][$i] = array();
        }
        $schedules = \App\Schedule::where("place_id", $id)->where("day", null)->orderBy("hour_start")->orderBy("id")->get();
        $schedules = $schedules->where("year_seq", $schedules->max('year_seq'));

        foreach ($schedules as $j=>$schedule) {
            $pos = $schedule->weekday;
            array_push($view['weekdays'][$pos], $schedule);
        }
        $view['events'] = \App\Schedule::where("place_id", $id)->whereRaw("day >= CURRENT_DATE")->orderBy("hour_start")->orderBy("id")->get();

        return view('dashboard/place', $view);
    }
}
