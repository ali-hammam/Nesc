<?php
namespace DB\Model\Traits;
include __DIR__ . '\DataManipulationQuery.php';
include __DIR__ . '\DataSearchQuery.php';
include __DIR__ . '\JoinsType.php';
include __DIR__ . '\ShowColumns.php';
include __DIR__ . '\RecordSelection.php';



trait SelectedData
{
    use DataManipulationQuery , DataSearchQuery , JoinsType , ShowColumns , RecordSelection;
    protected $sql = '';
    public function getQuery(){
        return $this->sql;
    }

    //get current ModelName
    protected function getClass() {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }
}