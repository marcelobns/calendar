<?php
/**
 * @author Marcelo Barbosa
 */
namespace source\modules;

class AppController extends \Anotherwise\Bonus\Controller{
    function __construct(){
        parent::__construct();
        date_default_timezone_set('America/Boa_Vista');

        $this->view->title = "Salas - DERCA";
    }
    function dump($object){
        echo "<pre>";
        var_dump($object);
        echo "</pre>";
    }
}
