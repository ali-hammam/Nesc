<?php


namespace Database\migrations;
use DB\Table\Facades\ColumnPropertyFacade;
use DB\Table\Facades\Table;
use DB\Table\Migrations\migration;

require_once('Nesc/DB/Table/Migrations/migration.php');
require_once('Nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once('Nesc/DB/Table/Facades/Table.php');

class items extends migration
{
    public function up()
    {
        Table::create($this->className , function (){

            $id = ColumnPropertyFacade::SetColumnBase('id')
                ->Number()
                ->primaryKey()
                ->getColumnProperty();

            $itemName = ColumnPropertyFacade::SetColumnBase('itemName')
                ->String(20)
                ->getColumnProperty();

            return [$id, $itemName];
        });
    }

    public function down()
    {
        Table::drop($this->className);
    }
}