<?php


namespace DB\Table;
use DB\DBConnection;

require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/DB/DBConnection.php');
//require_once ('../DBConnection.php');

class TableBluePrint
{
    private $dbConn;

    //create an instance which allow me to open and close connection
    public function __construct(){
       $this->dbConn = DBConnection::instance();
    }

    //Create new Table
    public function create($tableName , $callback){
        $arr = $callback();
        $query = 'CREATE TABLE '.$tableName." (";
        $query = $query.implode(',' , $arr);
        $query = $query.')';
        $this->TableValidation($query , 'Table Created Successfully');
    }

    //drop table
    public function drop($tableName){
        $query = 'DROP TABLE '.$tableName.';';
        $this->TableValidation($query , 'Table Dropped Successfully');
    }

    //add Column to a specific table
    public function addColumn($tableName , $column){
        $this->dbConn->openDbConnection('../env.txt');
        $query = 'ALTER TABLE '. $tableName;
        $query = $query.' ADD ' .$column;
        $this->TableValidation($query , 'Column Added Successfully');
        $this->dbConn->closeDbConnection();
    }

    //drop column from a specific table
    public function dropColumn($tableName , $columnName){
        $this->dbConn->openDbConnection('../env.txt');
        $query = 'ALTER TABLE '. $tableName;
        $query = $query.' DROP COLUMN '.$columnName;
        $this->TableValidation($query , 'Column Dropped Successfully');
        $this->dbConn->closeDbConnection();
    }

    //modify column type from a specific table
    public function modifyColumn($tableName , $column){
        $this->dbConn->openDbConnection('../env.txt');
        $query = 'ALTER TABLE '. $tableName;
        $query = $query.' MODIFY COLUMN '.$column;
        $this->TableValidation($query ,'Column Modified Successfully');
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