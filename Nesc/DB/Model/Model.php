<?php

/*include __DIR__ . '\Traits\SelectedData.php';
use DB\DBConnection;
require ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/DBConnection.php');*/
require_once ('ModelTemplate.php');

class Model extends ModelTemplate
{
    /*use  SelectedData;*/

    protected $dbConn;

}