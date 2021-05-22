<?php

namespace Nesc\Router;
require_once ('RouterTemplate.php');

class Router extends RouterTemplate
{
    public function runCallback($callback){
        call_user_func($callback);
    }

    public function uri(){
        return $_SERVER['REQUEST_URI'];
    }
}