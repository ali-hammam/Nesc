<?php

include __DIR__ . '\DataManipulationQuery.php';
include __DIR__ . '\DataSearchQuery.php';
trait SelectedData
{
    use DataManipulationQuery , DataSearchQuery;
    protected $sql = '';
    public function getQuery(){
        return $this->sql;
    }
}