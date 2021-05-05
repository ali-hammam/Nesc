<?php

use \Model\Person;
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Person.php');
use \Model\Order;
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Order.php');

$person = new Person();
/*$arr = $person->select(['firstName'])->orderBy(['age DESC' , 'firstName ASC'])->runSelect();
echo json_encode($arr);*/

$orders = $person->order();


/*$arr = $person->select($columns)->runSelect();
echo json_encode($arr);;*/
