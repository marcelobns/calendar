<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Pages extends AppController {
    function index() {
        $this->render('pages/index', 'default');
    }
}
