<?php
namespace Commands\classFormat;
require_once ('makeCommands.php');
require_once __DIR__."/../Command.php";
use makeCommands;

class Maker implements \Commands\Command
{
    use makeCommands;
    public function execute($type , $fileName = null){
        $command = explode('-' , $type);
        if($command[0] == 'make'){
            if($command[1] == 'model'){
                $this->makeModel($fileName);
            }else if($command[1] == 'migration'){
                $this->makeMigration($fileName);
            }else if($command[1] == 'controller'){
                $this->makeController($fileName);
            }
        }
    }
}