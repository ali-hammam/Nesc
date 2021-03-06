<?php

namespace Nesc\Router;
require_once ('RouterTemplate.php');
require_once ('Request.php');
include __DIR__.'/Traits/ControllerParser.php';
use Controller\Controller;
use Traits\ControllerParser;


class Router extends RouterTemplate
{
    use ControllerParser;
    private $requestMethod;

    public function __construct(){
        Request::instantiate();
    }

    public function runCallback($callback){
        is_string($callback) ? $this->routeToController($callback) : call_user_func($callback);
    }

    public function requestMethodChecker($uri , $callback , $methodName){
        if ('/nesc' . $uri == $this->uri()) {
            $this->urlFound = 1;
            $this->requestMethod = $methodName;
            $this->runCallback($callback);
        }
    }

    public function routeToController($value){
        $controllerFile = $this->ControllerFile($value);
        $methodName = $this->methodName($value);

        $this->requestMethod !== 'post' ?  : Request::setData($_POST);

        $controller = new Controller();
        $controller->run($controllerFile , $methodName);

    }

    public function uri(){
        return $_SERVER['REQUEST_URI'];
    }
}