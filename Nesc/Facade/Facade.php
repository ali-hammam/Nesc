<?php


namespace Nesc\Facade;


abstract class Facade
{
    public abstract function setFacadeAccessor();

    public static function __callStatic($method , $args){
        $obj = static::setFacadeAccessor();
        return $obj->$method(...$args);
    }
}