<?php
namespace Database\migrations;
use DB\Table\Facades\ColumnPropertyFacade;
use DB\Table\Facades\Table;
use DB\Table\Migrations\migration;

require_once('Nesc/DB/Table/Migrations/migration.php');
require_once('Nesc/DB/Table/Facades/ColumnPropertyFacade.php');
require_once('Nesc/DB/Table/Facades/Table.php');

class persons extends migration
{
    public function up(){
        Table::create($this->className , function (){
            $id = ColumnPropertyFacade::SetColumnBase('Id')
                ->Number()
                ->primaryKey()
                ->getColumnProperty();

            $firstName = ColumnPropertyFacade::SetColumnBase('FirstName')
                ->String(10)
                ->getColumnProperty();

            return [$id, $firstName];
        });
    }

    public function down(){
        Table::drop($this->className);
    }

}