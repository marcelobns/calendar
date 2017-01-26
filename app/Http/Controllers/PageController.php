<?php

namespace App\Http\Controllers;

use App\Group;
use App\Place;
use App\Schedule;
use App\Http\Controllers\Controller;
use Input;

class PageController extends AppController {
    public function index($month = null) {
        $input = (object)Input::all();

        if(@$input->calendar == 'group') {
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
                                    ->joinPlace()->where('places.group_id','=',$input->group_id)
                                    ->orderBy("hour_start")->get();
            foreach ($view['schedules'] as $j=>$schedule) {
                array_push($view['days'][$schedule->day], $schedule);
            }
            $view['prev'] = url("/".date('Y-m', strtotime("-1 month", strtotime($month)))).'?'.http_build_query($input);
            $view['next'] = url("/".date('Y-m', strtotime("+1 month", strtotime($month)))).'?'.http_build_query($input);

        }
        else if(@$input->calendar == 'place'){
            $view['place'] = Place::find($input->place_id);
            $view['weekdays'] = [];
            for ($i=0; $i <= 6; $i++) {
                $view['weekdays'][$i] = array();
            }
            $schedules = Schedule::where("place_id", $input->place_id)->where("day", null)->orderBy("hour_start")->orderBy("id")->get();
            $schedules = $schedules->where("year_seq", $schedules->max('year_seq'));

            foreach ($schedules as $j=>$schedule) {
                $pos = $schedule->weekday;
                array_push($view['weekdays'][$pos], $schedule);
            }
        }
        else {
            if(@$input->search_text){
                $query = Schedule::where(function($query){
                    $query->orWhereRaw("day >= current_date()");
                    $query->orWhereRaw("day is null");
                    $query->where("year_seq", $query->max('year_seq'));
                });

                $query->where(function($query) use ($input){
                    $query->orWhereRaw("name like '%{$input->search_text}%'");
                    $query->orWhereRaw("responsible like '%{$input->search_text}%'");
                });
            }
            else {
                $query = Schedule::whereRaw("day >= current_date()");
            }
            $view['schedules'] = $query->orderBy('day')->orderBy('hour_start')->paginate(15);
        }
        $view['groups'] = Group::orderBy('name')->pluck('name', 'id');
        $view['places'] = !@$input->group_id ? [] : Place::where('group_id', $input->group_id)->orderBy('name')->pluck('name', 'id');

        $view['group_id'] = @$input->group_id;
        $view['month'] = $month;

        $view['form'] = $input;

        return view('pages.index', $view);
    }
}
