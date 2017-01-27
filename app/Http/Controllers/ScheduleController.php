<?php

namespace App\Http\Controllers;

use App\Place;
use App\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function save(Request $request){
        $input = $request->input('schedule');

        if(!empty($input['extend_date'])){
            $dayStart = date_create($input['day']);
            $dayEnd = date_create($input['extend_date']);
            $interval = date_diff($dayStart, $dayEnd)->format('%a');
            $dayAdd = $dayStart;
            for($i=0; $i <= $interval; $i++) {
                $save = true;
                $dayString = date_format($dayAdd, 'Y-m-d');
                if(date('N', strtotime($dayString)) == 6 && !$input['sabado']){
                    $save = false;
                }
                if(date('N', strtotime($dayString)) == 7 && !$input['domingo']){
                    $save = false;
                }
                if($save){
                    $schedule = new Schedule();
                    $schedule->fill($input);
                    $schedule->day = date_format($dayAdd, 'Y-m-d');
                    $schedule->save();
                }
                date_add($dayAdd, date_interval_create_from_date_string("1 days"));
            }
            return redirect($request->input('referer'));
        } else {
            $schedule = new Schedule();
            $schedule->fill($input);
            if($schedule->save()){
                return redirect($request->input('referer'));
            }
        }
    }
    public function add($day = null, $group = null){
        $view['places'] = Place::where("group_id", $group)->orderBy("name")->pluck('name', 'id');
        $view['schedule'] = [
            'day' => $day,
            'group' => $group
        ];
        return view('schedule.add', $view);
    }
    public function edit($id) {
        $view['schedule'] = Schedule::where("id", $id)->first();
        $view['day_name'] = $view['schedule']->day;
        return view('schedule.edit', $view);
    }
    public function delete(Request $request){
        $input = $request->input('schedule');
        if(isset($input['id'])){
            if(Schedule::where('id', $input['id'])->delete()){
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function check($place_id, $dayStart, $dayEnd, $hourStart, $hourEnd){
        $raw = "place_id = $place_id and ((day between '$dayStart' and '$dayEnd') OR weekday  = (DAYOFWEEK('$dayStart')-1) ) AND (	('$hourStart' between hour_start and hour_end) OR ('$hourEnd' between hour_start and hour_end) OR (hour_start between '$hourStart' and '$hourEnd') OR (hour_end between '$hourStart' and '$hourEnd'))";
        $result = Schedule::whereRaw($raw)->get();
        return $result;
    }
    public function add_weekday($place_id = null, $weekday = null){
        $view['schedule'] = [
            'place_id' => $place_id,
            'weekday' => $weekday,
            'weekday_name' => Schedule::getWeekdayName($weekday),
            'year_seq' => Schedule::where("day", null)->max('year_seq')
        ];
        return view('schedule.add_weekday', $view);
    }
    public function save_weekday(Request $request){
        $input = $request->input('schedule');
        $weekday = explode(',', $input['weekdays']);
        for ($i=0; $i < sizeof($weekday); $i++) {
            if(sizeof($weekday) > 1){
                $input['weekday'] = $weekday[$i];
            }
            $schedule = new Schedule();
            $schedule->fill($input);
            $schedule->save();
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
