<?php
namespace DB\Table\Migrations;
use DBConnection;
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/DBConnection.php');

abstract class migration
{
    private $dbConn;
    protected $className;
    public function __construct(){
        $this->dbConn = DBConnection::instance();
        $this->className = $this->getClass();
    }

    public function run($operation){
        $this->dbConn->openDbConnection($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/env.txt');
        if(strcmp(strtolower($operation) , 'create') === 0){
            $this->up();
        }else if(strcmp(strtolower($operation) , 'drop') === 0){
            $this->down();
        }
        $this->dbConn->closeDbConnection();
    }

    public abstract function up();

    public abstract function down();

    public function getClass() {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }
}