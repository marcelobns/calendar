<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        $view['groups'] = \App\Group::orderBy('id', 'desc')->get();
        return view('group.index', $view);
    }
    public function form($id = null){
        $view['group'] = \App\Group::firstOrNew(['id' => $id]);
        return view('group.form', $view);
    }
    public function save(){
        $group = \App\Group::updateOrCreate(
            ['id' => $_POST['group']['id']],
            $_POST['group']
        );
        return redirect("dashboard/groups");
    }
    public function delete(){

    }
}
