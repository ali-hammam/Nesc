<?php
require_once ('Database/migrations/persons.php');
use \Database\migrations\persons;
$person = new persons();
$person->run('create');

