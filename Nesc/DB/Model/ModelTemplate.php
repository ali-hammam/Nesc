<?php
namespace DB\Model;
include __DIR__ . '\Traits\SelectedData.php';
include __DIR__ . '\Traits\Helpers.php';
use DB\DBConnection;
use DB\Model\Traits\Helpers;
use DB\Model\Traits\SelectedData;
require ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/DBConnection.php');

class ModelTemplate
{
    use SelectedData , Helpers;
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
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->arr[$i] = $row;
                $i++;
            }
        }

        $this->dbConn->closeDbConnection();
        $this->sql = '';
        return  $this;
    }

    //get all the table rows or get a specific row
    public function get($columnNo = null){
        $columnNo === null ? $temp = $this->arr : $temp = $this->arr[$columnNo-1];
        $this->arr = [];
        return $temp;
    }

    //get the first row of the table
    public function first(){
        $temp =  $this->arr[0];
        $this->arr = [];
        return $temp;
    }

    //get the last row of the table
    public function last(){
        $temp = $this->arr[sizeof($this->arr) - 1];
        $this->arr = [];
        return $temp;
    }

}