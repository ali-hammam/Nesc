<?php


namespace DB\Table;
use DBConnection;

require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/DBConnection.php');

class TableBluePrint
{
    private $dbConn;
    public function __construct(){
       $this->dbConn = DBConnection::instance();
    }

    //Create new Table
    public function create($tableName , $callback){
        $arr = $callback();
        $this->dbConn->openDbConnection('../env.txt');
        $query = 'CREATE TABLE '.$tableName." (";
        $query = $query.implode(',' , $arr);
        $query = $query.')';
        $this->TableValidation($query , 'Table Created Successfully');
        $this->dbConn->closeDbConnection();
    }

    //drop table
    public function drop($tableName){
        $this->dbConn->openDbConnection('../env.txt');
        $query = 'DROP TABLE '.$tableName.';';
        $this->TableValidation($query , 'Table Dropped Successfully');
        $this->dbConn->closeDbConnection();
    }

    //alter column in a table with ADD or DROP or MODIFY
    public function modifyColumn($tableName , $column , $operation){

        $this->dbConn->openDbConnection('../env.txt');
        $query = 'ALTER TABLE '. $tableName;
        switch ($operation){
            case 'ADD':
                $query = $query.' ADD ' .$column;
                $this->TableValidation($query , 'Column Added Successfully');
            break;

            case 'MODIFY':
                $query = $query.' MODIFY COLUMN '.$column;
                $this->TableValidation($query ,'Column Modified Successfully');
            break;

            case 'DROP':
                $query = $query.' DROP COLUMN '.$column;
                $this->TableValidation($query , 'Column Dropped Successfully');
            break;

            default:
                echo 'Operation Not Exist';
        }
        $this->dbConn->closeDbConnection();
    }

    //to validate the creation or drop of table or column
    private function TableValidation($query , $success){
        if ($this->dbConn->getConn()->query($query) === TRUE) {
            echo "<br>".$success;
        } else {
            echo "<br>".$this->dbConn->getConn()->error;
        }
    }
}