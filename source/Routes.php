<?php
/**
* @author PHP Bonus Framework
*/
namespace Anotherwise\Bonus;

class Routes {
    public static function map(){
        return array(
            //launcher
            "/^$/" => array("controller"=>"Pages","action"=>"index"),
            //generic route
            "/^[a-zA-Z0-9\_\-]/i" => array("controller"=>0, "action"=>1,"param"=>array()),
            //custom routes
            "/^(register)$/i" => array("controller"=>"Users", "action"=>"register"),
            "/^(login)$/i" => array("controller"=>"Users", "action"=>"login"),
            "/^(logout)$/i" => array("controller"=>"Users", "action"=>"logout"),
        );
    }
    public static function guest(){
        return array(
            //launcher
            "" => true,
            //custom authorizations
            "page/{name}" => true,
            "post/{title}" => true,
            "register" => true,
            "login" => true,

            //Temporary
            "dashboard" => true,
            "dashboard/group" => true,
            "dashboard/group/add" => true,
            "dashboard/group/edit/{id}" => true,
            "dashboard/group/delete/{id}" => true,
        );
    }
}
