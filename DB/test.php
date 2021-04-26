<?php

/*new Table(function(){
    return [
      'column ' => 'props',
      'column' => 'props'
    ];
})->create();*/

//ColumnPropertyFacade test
require_once('Table/ColumnPropertyFacade.php');
echo \DB\Table\ColumnPropertyFacade::String(10)->getColumnProperty().'<br>';
echo \DB\Table\ColumnPropertyFacade::Number()->primaryKey()->getColumnProperty();


//Opening&closing Db connection
/*require_once ('DBConnection.php');
$dbconnection = DBConnection::instance();
$dbconnection->openDbConnection('../env.txt');
$sql = 'ALTER TABLE Persons
DROP COLUMN LastName';

if ($dbconnection->getConn()->query($sql) === TRUE) {
    echo "Table column dropped successfully";
} else {
    echo "Error dropping column: " . $dbconnection->getConn()->error;
}

$dbconnection->closeDbConnection();

$dbconnection->openDbConnection('../env.txt');
$sql = 'ALTER TABLE Persons
ADD LastName VARCHAR(30)';
if ($dbconnection->getConn()->query($sql) === TRUE) {
    echo "Table column added successfully";
} else {
    echo "Error adding column: " . $dbconnection->getConn()->error;
}

$dbconnection->closeDbConnection();*/
