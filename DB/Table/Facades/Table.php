<?php

namespace DB\Table\Facades;
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Table/TableBluePrint.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/Facade/Facade.php');
use DB\Table\TableBluePrint;
use Facade\Facade;

class Table extends Facade{

    public function setFacadeAccessor()
    {
        return new TableBluePrint();
    }
}