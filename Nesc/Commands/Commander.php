<?php
namespace Commands;
require_once ('classFormat/Maker.php');
require_once ('Migrations/Migrate.php');
require_once ('Migrations/Drop.php');
require_once('Command.php');
use Commands\classFormat\Maker;
use Commands\Migrations\Drop;
use Commands\Migrations\Migrate;

class Commander
{
    private $commander;

    public function setCommand(Command $command){
        $this->commander = $command;
    }

    public function execute($directoryType , $args = null){
        strpos($directoryType , '-') ? $commandType = explode('-', $directoryType)[0] : $commandType = $directoryType;
        $this->commandMapper($commandType);
        $this->commander->execute($directoryType , $args);
    }

    public function commandMapper($commandType){
        if(strtolower($commandType) === 'make'){
            $this->setCommand(new Maker());
        }else if(strtolower($commandType) === 'migrate'){
            $this->setCommand(new Migrate());
        }else if(strtolower($commandType) === 'drop'){
            $this->setCommand(new Drop());
        }
    }

}