<?php

use DB\persons;
require_once ('../Nesc/DB/persons.php');

$person = new persons();
$arr = $person->select(['*'])->orderBy(['age DESC' , 'firstName ASC'])->runSelect();
echo json_encode($arr);
