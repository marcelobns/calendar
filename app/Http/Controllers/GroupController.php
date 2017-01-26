<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;

class GroupController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        $view['groups'] = Group::orderBy('id', 'desc')->get();
        return view('group.index', $view);
    }
    public function form($id = null){
        $view['model']['group'] = Group::firstOrNew(['id' => $id]);
        return view('group.form', $view);
    }
    public function save(Request $request){
        $group = Group::updateOrCreate(
            ['id' => $request->input('group.id')],
            $request->input('group')
        );
        return redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete(Request $request){

    }
}
