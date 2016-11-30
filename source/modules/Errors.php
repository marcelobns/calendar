<?php
/**
* @author Marcelo Barbosa
*/
namespace Source\Modules;

class Errors extends AppController {
    function error404(){
        echo "<h1>Error 404!</h1>";
        echo "Page not found";
    }
    function error403(){
        echo "<h1>Error 403!</h1>";
        echo "Forbidden Access";
    }
}
