<?php


trait DBCreations
{


    private function createDB($dbName){
        $sql = 'CREATE DATABASE '.$dbName;
        if($this->conn === null){
            echo "There is no connection to a server";
        }else if($this->conn->query($sql)){
            echo "Database created successfully";
        }else{
            echo "Error creating database: " .$this->conn->error;
        }
    }
    public function createTable($conn , $tableName){

    }


    public function query(){

    }
}