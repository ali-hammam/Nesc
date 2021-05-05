<?php

namespace DB\Model\Traits;
trait DataManipulationQuery
{

    protected $table;
    //select data from table
    public function select($selectedColumns){
        $columns = implode(',', $selectedColumns);
        $this->sql = 'SELECT '.$columns.' FROM '.$this->table;
        return $this;
    }

    //insert into table
    public function insert($columns){
        if(sizeof($columns) === 0){
            return 'empty array';
        }

        $this->sql = "INSERT INTO ".$this->table." (".implode(',',array_keys($columns)).")".
                " VALUES (".implode(',' , $columns).")";
        return $this;
    }

    //update the table
    public function update($columns){
        if(sizeof($columns) === 0){
            return 'empty array';
        }

        $dataAttributes = array_map(function($value, $key) {
            return $key.'="'.$value.'"';
        } ,  array_values($columns), array_keys($columns));
        $data = implode($dataAttributes);

        $this->sql = 'UPDATE '.$this->table.' SET '.$data;
        return $this;
    }

    //delete from the table *you can use where function in delete*
    public function delete(){
        $this->sql = 'DELETE FROM '.$this->table;
        return $this;
    }

    //it shows column Name and properties like INT or Varchar
    public function show($tableName){
        $this->sql =  $this->sql.'SHOW COLUMNS FROM '.$tableName;
        return $this;
    }


}