<?php


namespace DB\Table\Traits;


trait ColumnName
{
    public function SetColumnBase ($columnName)
    {
        $this->columnProperty = $this->columnProperty . $columnName;
        return $this;
    }
}