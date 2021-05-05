<?php
    require_once ('Database/migrations/orders.php');
    use \Database\migrations\orders;
    //$person = new persons();
    //$person->run('create');
    //$person->run('drop');
    $orders = new orders();
    $orders->run('create');
