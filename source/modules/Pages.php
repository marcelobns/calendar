<?php
/**
* @author PHP Bonus Framework
*/
namespace Source\Modules;

class Pages extends \Anotherwise\Bonus\Controller {
    function index() {
        $this->view->title = "Hello World | Bonus";
        $this->view->headerText = "Hello World";
        $this->view->paragraphText = "This seed is used to demonstrate how to start your PHP project.";

        $this->render('pages/index', 'default');
    }
}
