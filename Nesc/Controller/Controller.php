<?php
namespace Controller;
require_once __DIR__.'/Traits/Helpers.php';
use Helpers;

class Controller {
    use Helpers;

    public  function run($value){
        $methodName = $this->methodName($value);
        $controllerFile = $this->ControllerFile($value);
        $this->loadControllerFile($controllerFile);
        $this->callControllerMethod($controllerFile , $methodName);
    }

}