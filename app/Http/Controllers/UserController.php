<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends AppController {
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        $view['users'] = \App\User::get();
        return view('user/index', $view);
    }
    public function form($id = null) {
        $view['user'] = \App\User::findOrNew($id);
        return view('user/form', $view);
    }
    public function save() {
        $_POST['password'] = bcrypt($_POST['password']);

        $user = \App\User::findOrNew($_POST['id']);
        $user->fill($_POST);
        if($user->save()){
            return redirect('dashboard/users');
        }
    }
}
