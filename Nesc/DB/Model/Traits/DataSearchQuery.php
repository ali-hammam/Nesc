<?php

namespace DB\Model\Traits;
trait DataSearchQuery
{

    //where statement using IN or BETWEEN keywords or ordinary operators
    public function where($columnName , $operator , $value){
        $this->checkWhereKey('WHERE' , $columnName , $operator , $value);
        return $this;
    }

    //AND keyword
    public function andWhere($columnName , $operator ,$value){
        $this->checkWhereKey('AND' , $columnName , $operator , $value);
        return $this;
    }

    //OR keyword
    public function orWhere($columnName , $operator , $value){
        $this->checkWhereKey('OR' , $columnName , $operator , $value);
        return $this;
    }

    //check if the keyword that came after where statement is IN or AND or ordinary operator like (=)
    private function checkWhereKey($keyword , $columnName , $operator , $value){
        if(strtolower($operator) === strtolower('IN')){
            $in = implode(',' , $value);
            $this->sql = $this->sql . ' ' . $keyword . ' ' . $columnName . ' IN (' . $in . ')';
        }else if(strtolower($operator) === strtolower('BETWEEN')){
            $in = implode(' AND ' , $value);
            $this->sql = $this->sql . ' ' . $keyword . ' ' . $columnName . ' BETWEEN ' . $in;
        }else {
            $this->sql = $this->sql . ' ' . $keyword . ' ' . $columnName . ' ' . $operator . ' ' . $value;
        }
    }

    //groupBy keyword
    public function groupBy($columnName){
        $this->sql = $this->sql . ' GROUP BY ' .$columnName;
        return $this;
    }

    //sorting the table according to column
    public function orderBy($columnName , $sortType = 'ASC'){
        if(is_array($columnName)){
            $query = implode(',' , $columnName);
            //make the user put his sortType for every column
            $this->sql = $this->sql . ' ORDER BY ' . $query;
        }else {
            $this->sql = $this->sql . ' ORDER BY ' . $columnName . ' ' . $sortType;
        }
        return $this;
    }
}