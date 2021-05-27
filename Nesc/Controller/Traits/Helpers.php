<?php


trait Helpers {
    public function ControllerFile($value){
        return substr($value , 0 , strpos($value , '@'));
    }

    public function loadControllerFile($controllerFile){
        require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Controller/' .$controllerFile.'.php');
    }

    public function methodName($value){
        return substr($value ,  strpos($value , '@')+1 , strlen($value)-1);
    }

    public function callControllerMethod($controllerFile , $method){
        if(strpos($controllerFile , '/') == false){
            $controllerClass = new $controllerFile();
            $controllerClass->$method();
            return;
        }
        $name = substr($controllerFile , strpos($controllerFile , '/') + 1 ,strlen($controllerFile)-1);
        $this->callControllerMethod($name , $method);
    }
}