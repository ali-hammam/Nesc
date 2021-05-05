<?php

namespace DB\Model\Traits;
include __DIR__ . '\DataManipulationQuery.php';
include __DIR__ . '\DataSearchQuery.php';
include __DIR__ . '\JoinsType.php';
trait SelectedData
{
    use DataManipulationQuery , DataSearchQuery , JoinsType;
    protected $sql = '';
    public function getQuery(){
        return $this->sql;
    }
}