<?php

class DBConnection
{
    private static $dbConnection = null;
    private  $conn;
    private function __construct(){}

    /*
        create the singleton instance
    */
    public static function instance(){
        if(self::$dbConnection === null){
            self::$dbConnection = new DBConnection();
        }
        return self::$dbConnection;
    }

    /*
        for opening connection to a database
    */
    public function openDbConnection(){
        $dbProps = $this->readDbFromEnv('./env.txt');
        $this->conn = new mysqli($dbProps['server_name'] , $dbProps['username'] ,'' , $dbProps['database_name']);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    /*
        closing database connection
    */
    public  function closeDbConnection(){
        $this->conn = null;
    }

    /*
        for reading DB initialization from .env
    */
    private function readDbFromEnv($wFile,$d = "="){
        $arr = @file($wFile);
        $res = [];
        if ( is_array($arr) == true )
        {
            foreach ($arr as $line)
            {
                $line = trim($line);
                if ( ($line !="") && (substr($line,0,1) != "#") )
                {
                    list($key,$val) = explode($d,$line,2);
                    $key = trim($key);
                    $val = trim($val);
                    $res[$key] = $val;
                }
            }
        }
        return $res;
    }
}