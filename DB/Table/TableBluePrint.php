<?php


namespace DB\Table;


class TableBluePrint
{
    private $columnProperties;
    public function __construct(){
        $this->columnProperties = new ColumnProperty();
    }
}