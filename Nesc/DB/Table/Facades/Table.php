<?php

namespace DB\Table\Facades;
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/DB/Table/TableBluePrint.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/Facade/Facade.php');
use DB\Table\TableBluePrint;
use Nesc\Facade\Facade;

class Table extends Facade{

    // i want to route the functions in TableBluePrint()
    public function setFacadeAccessor()
    {
        return new TableBluePrint();
    }
}