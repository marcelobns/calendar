<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends AppController
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function profile($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
