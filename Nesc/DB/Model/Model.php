<?php
namespace DB\Model;
require_once ('ModelTemplate.php');
use DB\Model\ModelTemplate;
use Model\Person;

class Model extends ModelTemplate
{

    protected $table = '';

    //return the array came from oneToManyJson()
    public function with($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $this->arr= $this->join($relatedModel, $foreignKey, $primaryKey)->runSelect()->get();
        $this->arr =$this->oneToManyJson($relatedModel , $this->arr);
        $this->arr = array_values($this->arr);
        return $this->get();
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

    //create oneToOne relation
    public function hasOne($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $temp = $this->arr;
        $columns = $this->getAllColumnsWithoutEdit($relatedModel);
        unset($columns[array_search($foreignKey , $columns)]);
        $obj = $this->select($columns , $relatedModel)
            ->where($foreignKey , '=' , $temp[0]['id'])
            ->limit(1)
            ->runSelect()
            ->get();
        if(empty($obj)){
            return $temp;
        }

        $obj = $obj[0];
        $temp[0][$relatedModel] = $obj;
        return $temp[0];
    }

    //create oneToMany relation
    public function hasMany($relatedModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $this->putDefaultForeignKey($foreignKey);
        $temp = $this->arr;
        $columns = $this->getAllColumnsWithoutEdit($relatedModel);
        unset($columns[array_search($foreignKey , $columns)]);
        $obj = $this->select($columns , $relatedModel)
                    ->where($foreignKey , '=' , $temp[0]['id'])
                    ->runSelect()
                    ->get();

        if(empty($obj)){
            return $temp;
        }
        $temp[0][$relatedModel] = $obj;
        return $temp[0];
    }

    //reversed oneToOne or oneToMany relation
    public function belongsTo($primaryModel , $foreignKey = null , $primaryKey = 'id'){
        $foreignKey = $primaryModel.'Id';
        $temp = $this->arr;
        $columns = $this->getAllColumnsWithoutEdit($primaryModel);

        $obj = $this->select($columns , $primaryModel)
                    ->where($primaryKey , '=' , $temp[0][$foreignKey])
                    ->limit(1)
                    ->runSelect()
                    ->get();

        if(empty($obj)){
            return $temp;
        }

        $obj = $obj[0];
        $temp[0][$primaryModel] = $obj;
        unset($temp[0][$foreignKey]);
        return $temp[0];
    }

    public function find($id){
        return $this->select(['*'])
                    ->where('id' , '=' , $id)
                    ->runSelect();
    }


}