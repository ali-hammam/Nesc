<?php


namespace DB\Table\Facades;
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Table/ColumnProperty.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/Facade/Facade.php');
use DB\Table\ColumnProperty;
use Facade\Facade;

class ColumnPropertyFacade extends Facade{
    public function setFacadeAccessor(){
        return new ColumnProperty();
    }
}