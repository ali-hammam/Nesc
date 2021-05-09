<?php

namespace DB\Model;
include __DIR__ . '\Traits\SelectedData.php';
use DB\DBConnection;
use DB\Model\Traits\SelectedData;

require ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/DBConnection.php');
class ModelTemplate
{
    use SelectedData;
    protected $dbConn;
    protected $arr = [];

    public function __construct(){
        $this->dbConn = DBConnection::instance();
    }

    //to run any table operation except select
    public function run($successMessage = ''){
        $db = $this->dbConn->openDbConnection($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/env.txt');
        if ($db->query($this->sql) === TRUE) {
            echo $successMessage;
        } else {
            echo "Error: " . $this->sql . "<br>" . $db->error;
        }
        $this->dbConn->closeDbConnection();
        $this->sql = '';
    }

    // put the values of each row in $arr
    public function runSelect(){
        $this->arr = [];
        $i = 0;
        $db = $this->dbConn->openDbConnection($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/env.txt');
        $result = $db->query($this->sql);
//        var_dump($result);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->arr[$i] = $row;
                $i++;
            }
        } else {
            echo "0 results";
        }

        $this->dbConn->closeDbConnection();
        $this->sql = '';
        return sizeof($this->arr) === 0 ? 'empty array' : $this->arr;
    }

    //get all the table rows or get a specific row
    public function get($columnNo = null){
        return $columnNo === null ? $this->arr : $this->arr[$columnNo-1];
    }

    //get the first row of the table
    public function first(){
        return $this->arr[0];
    }

    //get the last row of the table
    public function last(){
        return $this->arr[sizeof($this->arr) - 1];
    }

    //get current ModelName
    protected function getClass() {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }
}