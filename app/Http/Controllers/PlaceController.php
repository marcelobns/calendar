<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaceController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        $view['places'] = \App\Place::orderBy('id', 'desc')->get();
        return view('place.index', $view);
    }
    public function form($id = null){
        $view['place'] = \App\Place::firstOrNew(['id' => $id]);
        $view['groups'] = \App\Group::orderBy('name')->pluck('name', 'id');
        return view('place.form', $view);
    }
    public function save(){
        $place = \App\Place::updateOrCreate(
            ['id' => $_POST['place']['id']],
            $_POST['place']
        );
        return redirect("dashboard/places");
    }
    public function delete(){

    }
}
