<?php


trait Helpers {

    public function loadControllerFile($controllerFile){
        require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Controller/' .$controllerFile.'.php');
    }

    public function callControllerMethod($controllerFile , $method){
        if(strpos($controllerFile, '/') !== false){
            $test = explode('/' , $controllerFile);
            $controllerFile = $test[sizeof($test)-1];
        }
        $controllerClass = new $controllerFile();
        $controllerClass->$method();
    }
}