<?php
    /*require_once ('Database/migrations/orders.php');
    use \Database\migrations\orders;
    //$person = new persons();
    //$person->run('create');
    //$person->run('drop');
    $orders = new orders();
    $orders->run('create');*/
/*require_once ('Database/migrations/items.php');
use \Database\migrations\items;
$items = new items();
$items->run('create');*/

require_once ('Database/migrations/orders_items.php');
use \Database\migrations\orders_items;
$order_item = new orders_items();
$order_item->run('create');
