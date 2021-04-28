<?php
require ('DB/DBConnection.php');
    /*$dbConnection = DBConnection::instance();
    $conn = $dbConnection->openDbConnection();
    $sql = "CREATE TABLE Persons (
    person_id INT(6) UNSIGNED AUTO_INCREMENT primary key,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table persons created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $conn = null;


    $conn = $dbConnection->openDbConnection();
    $sql = "CREATE TABLE Orders (
    order_id INT(6) UNSIGNED AUTO_INCREMENT primary key,
    OrderNumber int,
    person_id int UNSIGNED, 
    FOREIGN KEY(person_id) REFERENCES Persons(person_id)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table persons created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $dbConnection->closeDbConnection();*/


// autocall function at end of every function call
/*class test {
    function __construct(){}

    private function test1(){
        echo "In test1<br>";
    }
    private function test2(){
        echo "test2";
    }
    protected function test3(){
        echo "test3";
    }
    public function __call($method,$arguments) {
        if(method_exists($this, $method)) {
            call_user_func_array(array($this,$method),$arguments); //array($this , $method) means the method inside that class
            $this->test1();
            return;
        }
        return 'method didn\'t exist';
    }
}

$a = new test;
$a->test2();
echo $a->test3();*/
