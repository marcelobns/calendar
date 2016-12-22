<?php

namespace App\Http\Controllers;

use App\Group;
use App\Place;
use App\Schedule;
use App\Http\Controllers\Controller;

class PageController extends AppController {
    public function index() {
        $view['groups'] = \App\Group::orderBy('name')->get();
        $view['month'] = date('Y-m');
        $view['schedules'] = \App\Schedule::whereRaw("day >= current_date()")->orderBy('day')->orderBy('hour_start')->limit(15)->get();

        return view('pages.index', $view);
    }
}
