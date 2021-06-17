<?php


namespace Commands\Migrations;
require_once __DIR__ . "/../Command.php";
include_once 'config.php';
use Commands\Command;

class Drop implements Command
{

    public function execute($type, $fileName = null)
    {
        $tableName = explode('-', $type)[1];
        $dir = dirname(__FILE__, 4)."/Database/migrations";
        $a = scandir($dir);
        $found = 0;
        if(isset($a)) {
            array_splice($a, 0, 2);
            for ($i = 0; $i < sizeof($a); $i++) {
                $migrationName = substr($a[$i], 0, strpos($a[$i], '.'));
                if($migrationName === $tableName){
                    require_once ROOT. '/Database/migrations/' . $a[$i];
                    $path = '\Database\migrations\\';
                    $classPath = $path . $migrationName;
                    $migrationObj = new $classPath();
                    $migrationObj->run('drop');
                    unlink(ROOT.'Database\migrations\\'.$a[$i]);
                    $found = 1;
                }
            }
        }
        if($found === 0){
            echo 'Table ('.$tableName.') Not Existed';
        }
    }
}