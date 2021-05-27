<?php

namespace Nesc\Router;
require_once ('RouterTemplate.php');
require_once ('Request.php');
use Controller\Controller;


class Router extends RouterTemplate
{
    private $methodName;

    public function __construct(){
        Request::instantiate();
    }

    public function runCallback($callback){
        is_string($callback) ? $this->routeToController($callback) : call_user_func($callback);
    }

    public function requestMethodChecker($uri , $callback , $methodName){
        if ('/nesc' . $uri == $this->uri()) {
            $this->urlFound = 1;
            $this->methodName = $methodName;
            $this->runCallback($callback);
        }
    }

    public function routeToController($value){
        !$this->methodName == 'post' ?  : Request::setData($_POST);
        $controller = new Controller();
        $controller->run($value);

    }

    public function uri(){
        return $_SERVER['REQUEST_URI'];
    }
}