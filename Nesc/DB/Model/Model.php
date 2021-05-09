<?php
namespace DB\Model;
require_once ('ModelTemplate.php');

class Model extends ModelTemplate
{
    protected $table = '';

    //return the array came from oneToManyJson()
    public function with($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $this->arr = $this->join($relatedModel, $foreignKey, $primaryKey)->runSelect();
        $this->arr =$this->oneToManyJson($relatedModel , $this->arr);
        $this->arr = array_values($this->arr);
        return $this;
    }

    //create a left join to a specific related model
    public function join($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $columns = $this->mergeMultipleTableColumns($this->table , $relatedModel);
        $this->sql = $this->sql . $this->select($columns)
                ->LeftJoin($relatedModel , $this->joinsTableFormat($this->table,$primaryKey) , $this->joinsTableFormat($relatedModel,$foreignKey))
                ->orderBy($this->table.'_id')
                ->getQuery();
        return $this;
    }

    public function hasMany($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $temp = $this->arr;
        $columns = $this->getAllColumnsWithoutEdit($relatedModel);
        unset($columns[array_search($foreignKey , $columns)]);

        $obj = $this->select($columns , 'orders')
                    ->where($foreignKey , '=' , $temp[0]['id'])
                    ->runSelect()
                    ->get();

        if(empty($obj)){
            return $temp;
        }
        $temp[0][$relatedModel] = $obj;
        return $temp;
    }

    //make right join relationship according to the table the has the foreign key
    public function belongsTo($relatedModel , $foreignKey , $primaryKey = 'id'){
        $columns = $this->mergeMultipleTableColumns($this->getClass() , $relatedModel);
        $this->sql = $this->sql. $this->select($columns)
                ->rightJoin($relatedModel , $this->joinsTableFormat($this->getClass(),$primaryKey) , $this->joinsTableFormat($relatedModel,$foreignKey))
                ->getQuery();
        return $this;
    }
}