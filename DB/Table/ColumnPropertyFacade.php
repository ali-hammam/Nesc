<?php


namespace DB\Table;
require_once ('ColumnProperty.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/Facade/Facade.php');
use Facade\Facade;



class ColumnPropertyFacade extends Facade{
    public function setFacadeAccessor(){
        return new ColumnProperty();
    }
}