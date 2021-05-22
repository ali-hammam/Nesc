<?php


namespace Nesc\Router;


abstract class RouterTemplate{

    public abstract function runCallback($callback);

    public function get($uri , $callback){
        if('/nesc'.$uri == $this->uri()) {
            $this->runCallback($callback);
        }
    }

}