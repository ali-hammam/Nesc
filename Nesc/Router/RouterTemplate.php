<?php
namespace Nesc\Router;
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/Controller/Controller.php');
include __DIR__ . '\Traits\Errors.php';
use Traits\Errors;

abstract class RouterTemplate{
    use Errors;
    protected $urlFound = 0;

    public abstract function runCallback($callback);
    public abstract function requestMethodChecker($uri , $callback , $methodType);

    public function get($uri , $callback){
        $this->requestMethodChecker($uri , $callback , 'get');
    }

    public function post($uri , $callback){
        $this->requestMethodChecker($uri , $callback , 'post');
    }

    public function isUrlFound(){
        $this->urlFound === 1 ? : $this->error(404);
    }

    public function __destruct(){
        $this->isUrlFound();
    }
}