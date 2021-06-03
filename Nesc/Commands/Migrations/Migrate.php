<?php


namespace Commands\Migrations;
require_once __DIR__ . "/../Command.php";
include_once 'config.php';
use Commands\Command;

class migrate implements Command
{

    public function execute($type, $fileName = null)
    {
        $dir = ROOT."/Database/migrations";
        $a = scandir($dir);
        if(isset($a)) {
            array_splice($a, 0, 2);
            for ($i = 0; $i < sizeof($a); $i++) {
                require_once ROOT. '/Database/migrations/' . $a[$i];
                $migrationName = substr($a[$i], 0, strpos($a[$i], '.'));
                $path = '\Database\migrations\\';
                $classPath = $path . $migrationName;
                $migrationObj = new $classPath();
                $migrationObj->run('create');
            }
        }
    }
}