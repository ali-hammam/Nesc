<?php
trait DataManipulationQuery
{

    //select data from table
    public function select($selectedColumns){
        is_array($selectedColumns) ? $columns = implode(',', $selectedColumns) : $columns = $selectedColumns;
        $this->sql = 'SELECT '.$columns.' FROM '.$this->getClass();
        return $this;
    }

    //insert into table
    public function insert($columns){
        if(sizeof($columns) === 0){
            return 'empty array';
        }

        $this->sql = "INSERT INTO ".$this->getClass()." (".implode(',',array_keys($columns)).")".
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

        $this->sql = 'UPDATE '.$this->getClass().' SET '.$data;
        return $this;
    }

    //delete from the table
    public function delete(){
        $this->sql = 'DELETE FROM '.$this->getClass();
        return $this;
    }

    //get current ModelName
    private function getClass() {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }
}