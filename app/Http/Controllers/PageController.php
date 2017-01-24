<?php

namespace App\Http\Controllers;

use App\Group;
use App\Place;
use App\Schedule;
use App\Http\Controllers\Controller;
use Input;

class PageController extends AppController {
    public function index($month = null) {
        $group_id = Input::get('group_id');
        $place_id = Input::get('place_id');
        $search_text = Input::get('search_text');
        $calendar = Input::get('calendar');

        if($calendar == 'group') {
            $month = $month == null ? date('Y-m') : $month;
            $month_raw = str_replace('-', '', $month);

            $first_day = date('w',strtotime("$month-01"));
            $last_day = date('t',strtotime($month));

            $view['month'] = $month;
            $view['today'] = date('Y-m-d');
            $view['first_day'] = $first_day;

            $view['days'] = [];
            for ($i=1-$first_day; $i <= $last_day; $i++) {
                $view['days'][$month.'-'.str_pad($i, 2, "0", STR_PAD_LEFT)] = array();
            }
            $view['schedules'] = Schedule::Select('schedules.*')->whereRaw("EXTRACT(YEAR_MONTH FROM day) = '$month_raw'")
                                    ->joinPlace()->where('places.group_id','=',$group_id)
                                    ->orderBy("hour_start")->get();
            foreach ($view['schedules'] as $j=>$schedule) {
                array_push($view['days'][$schedule->day], $schedule);
            }
            //TODO links para prev, next
            $view['prev'] = url("/".date('Y-m', strtotime("-1 month", strtotime($month)))).'?'.http_build_query(Input::all());
            $view['next'] = url("/".date('Y-m', strtotime("+1 month", strtotime($month)))).'?'.http_build_query(Input::all());

        } else if($calendar == 'place'){
            $view['place'] = Place::find($place_id);
            $view['weekdays'] = [];
            for ($i=0; $i <= 6; $i++) {
                $view['weekdays'][$i] = array();
            }
            $schedules = Schedule::where("place_id", $place_id)->where("day", null)->orderBy("hour_start")->orderBy("id")->get();
            $schedules = $schedules->where("year_seq", $schedules->max('year_seq'));

            foreach ($schedules as $j=>$schedule) {
                $pos = $schedule->weekday;
                array_push($view['weekdays'][$pos], $schedule);
            }
            $view['events'] = Schedule::where("place_id", $place_id)->whereRaw("day >= CURRENT_DATE")->orderBy("hour_start")->orderBy("id")->get();
        } else {
            $query = Schedule::whereRaw("day >= current_date()")->orderBy('day')->orderBy('hour_start');
            if($search_text){
                $query->orWhereRaw("day is null");
                $query->where(function($query) use ($search_text){
                    $query->orWhereRaw("name like '%$search_text%'");
                    $query->orWhereRaw("responsible like '%$search_text%'");
                });
            }
            $view['schedules'] = $query->paginate(15);
        }

        $view['month'] = $month;
        $view['group_id'] = $group_id;

        $view['groups'] = Group::orderBy('name')->pluck('name', 'id');
        $view['places'] = !$group_id ? [] : Place::where('group_id', '=', $group_id)->orderBy('name')->pluck('name', 'id');

        $view['form']['group_id'] = $group_id;
        $view['form']['place_id'] = $place_id;
        $view['form']['search_text'] = $search_text;

        return view('pages.index', $view);
    }
}
