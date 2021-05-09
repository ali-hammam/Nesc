<?php

use \Model\Person;
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Person.php');
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Model/Order.php');
require ($_SERVER['DOCUMENT_ROOT'].'/Nesc/Nesc/DB/Table/Facades/ColumnPropertyFacade.php');

$person = new Person();

/*$obj = $person->with('orders')->get();
print_r(json_encode($obj));*/

$obj = $person->select(['*'] , 'persons')
              ->where('id' , '=' , 3)
              ->runSelect();


print_r(json_encode($obj->orders()));
