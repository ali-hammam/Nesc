<?php
/*require_once ('Database/migrations/phoneNumbers.php');
use \Database\migrations\phoneNumbers;*/
/*$person = new persons();
$person->run('create');*/
/*require_once ('Database/migrations/items.php');
use \Database\migrations\items;
$items = new items();
$items->run('create');*/
require_once ('Database/migrations/orders_items.php');
use \Database\migrations\orders_items;
$order_item = new orders_items();
$order_item->run('create');


