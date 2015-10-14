<?php
/**
* @author Marcelo Barbosa
*/
namespace Source\Modules;

class Pages extends \Anotherwise\Bonus\Controller {
    function index() {
        $this->view->helloWorld = "Hello World";
        $this->render('Index', 'pages/index');
    }
}
