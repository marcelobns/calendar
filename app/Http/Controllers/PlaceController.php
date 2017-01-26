<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Place;
use App\Group;

class PlaceController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        $view['places'] = Place::orderBy('id', 'desc')->get();
        return view('place.index', $view);
    }
    public function form($id = null){
        $view['model']['place'] = Place::firstOrNew(['id' => $id]);
        $view['groups'] = Group::orderBy('name')->pluck('name', 'id');
        return view('place.form', $view);
    }
    public function save(Request $request){
        $place = Place::updateOrCreate(
            ['id' => $request->input('place.id')],
            $request->input('place')
        );
        return redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete(){

    }
}
