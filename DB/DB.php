<?php


class DB
{
    /*use DBCreations;

    private $conn;
    private $serverName;
    private $userName;
    private $password;
    private $dbName;

    public function __construct($serverName , $userName , $password){
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->password = $password;
    }

    public function serverConnection(){
        $this->conn = new mysqli($this->serverName , $this->userName , $this->password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function databaseConnection($dbName){
        $this->dbName = $dbName;
        $this->conn = new mysqli($this->serverName , $this->userName , $this->password , $this->dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function closeConnection(){
        $this->conn = null;
    }*/
}