<?php
//namespace Controller;
use \Model\Person;
use \Model\Order;
use \Model\PhoneNumber;
use \Model\Item;
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Person.php');
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Order.php');
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/PhoneNumber.php');
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Item.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Nesc/nesc/Router/Request.php');
use Nesc\Router\Request;

class example{
    public function hi(){
        $item = new Item();
        print_r(json_encode($item->find(2)->orders()));
    }

    public function display(){
        echo 'dsadasdasdasdasdasdas';
    }

    public function insertPerson(){
       $fname = Request::get('fname');
       $lname = Request::get('lname');
       $age = Request::get('age');
       echo $fname;
    }
}