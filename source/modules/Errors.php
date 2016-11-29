<?php
/**
* @author Marcelo Barbosa
*/
namespace Source\Modules;

class Errors extends AppController {
    function error404(){
        echo "Error 404!";
    }
    function error403(){
        echo "Error 403!";
    }
}
