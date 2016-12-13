<?php
/**
* @author PHP Bonus Framework
*/
namespace Anotherwise\Bonus;

class Routes {
    public static function map(){
        return array(
            //launcher
            "/^$/" => array("controller"=>"Pages","action"=>"date"),
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
            "pages/{name}" => true,
            "posts/{title}" => true,
            "register" => true,
            "login" => true,

            "schedules/add/{day}/{group}" => true,
            "schedules/edit/{id}" => true,
            "schedules/delete" => true,
            "schedules/check/{place_id}/{dayS}/{dayE}/{hourS}/{hourE}" => true,
        );
    }
}
