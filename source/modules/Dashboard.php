<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Dashboard extends AppController {
    function index(){
        echo "index";
    }
    function group($action = "list", $id = null){
        switch ($action) {
            case 'list':
                echo "list";                
            break;
            case 'add':
                echo "add";
            break;
            case 'edit':
                echo "edit";
                echo $id;
            break;
            case 'delete':
                echo "delete";
            break;
        }
    }
    function place(){

    }
    function user(){

    }
}
