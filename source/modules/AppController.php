<?php
/**
 * @author Marcelo Barbosa
 */
namespace source\modules;

class AppController extends \Anotherwise\Bonus\Controller{
    function __construct(){
        parent::__construct();
        $this->view->title = "Salas";
    }
}
