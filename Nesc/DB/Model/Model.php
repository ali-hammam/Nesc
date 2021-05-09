<?php

namespace DB\Model;
require_once ('ModelTemplate.php');

class Model extends ModelTemplate
{
    protected $table = '';

    //make one to one relation to a related model table according to one table view
    public function hasOne($relatedModel , $foreignKey , $primaryKey = 'id'){

        $columns = $this->mergeTwoTableColumns($this->table , $relatedModel);
        $this->sql = $this->sql . $this->select($columns)
                ->leftJoin($relatedModel , $this->joinsTableFormat($this->table,$primaryKey) , $this->joinsTableFormat($relatedModel,$foreignKey))
                ->getQuery();
//        echo $this->sql;
        return $this;
    }









    public function oneToManyRelation($relatedModel , $foreignKey , $primaryKey = 'id'){
        $columns = $this->mergeTwoTableColumns($this->table , $relatedModel);
        $this->sql = $this->sql . $this->select($columns)
                ->LeftJoin($relatedModel , $this->joinsTableFormat($this->table,$primaryKey) , $this->joinsTableFormat($relatedModel,$foreignKey))
                ->orderBy($this->table.'_id')
                ->getQuery();
        return $this;
    }

    public function NullRelatedModelObj($relatedModel , $jsonObj){
        $relatedTableColumns = $this->getAllColumns($relatedModel);
        $count = [];

        for($i = 0; $i < sizeof($jsonObj); ++$i){
             for($j = 0; $j < sizeof($relatedTableColumns); ++$j){
                 if($jsonObj[$i][$relatedTableColumns[$j]] === null){
                     array_push($count , 0);
                 }else{
                     array_push($count , 1);
                 }
             }

             if (in_array(0, $count)){
                 for($j = 0; $j < sizeof($relatedTableColumns); ++$j){
                     unset($jsonObj[$i][$relatedTableColumns[$j]]);
                 }
                 $jsonObj[$i][$relatedModel] = null;
             }

             $count = [];
        }

        return $jsonObj;
    }

    public function ComposeRelatedModelObject($relatedModel , $jsonObj){
        $relatedTableColumns = $this->getAllColumns($relatedModel);
        $orders = [];

        for($i = 0; $i<sizeof($jsonObj); $i++){
            if(array_key_exists($relatedModel ,$jsonObj[$i])){
                continue;
            }

            for($j = 0; $j < sizeof($relatedTableColumns); $j++){
                $orders[$j][$relatedTableColumns[$j]] = $jsonObj[$i][$relatedTableColumns[$j]];
                unset($jsonObj[$i][$relatedTableColumns[$j]]);
            }

            $finArr = [];
            for($j = 0; $j < sizeof($orders); $j++){
                  $finArr[$relatedTableColumns[$j]] = $orders[$j][$relatedTableColumns[$j]];
            }

            $jsonObj[$i][$relatedModel] = [$finArr];
            $orders = [];
        }
        return $jsonObj;
    }

    public function GatherRelatedObjects($relatedModel , $jsonObj){
        $relatedTableColumns = $this->getAllColumns($relatedModel);
        /*$orders = $jsonObj[3]['orders'][0];
        unset($jsonObj[3]['orders']);
        array_push($jsonObj[4]['orders'] , $orders);*/

        $orders = [];
        $temp = 0;
        for($i = 0; $i < sizeof($jsonObj); $i++){

            if($jsonObj[$i][$relatedModel] === null){
                continue;
            }

            if($jsonObj[$i][$this->table.'_id'] === $jsonObj[$i+1][$this->table.'_id']){
                for($j = 0; $j < sizeof($jsonObj[$i]['orders']); $j++){
                    $orders[$temp] = $jsonObj[$i][$relatedModel][$j];
                    $temp++;
                }
                unset($jsonObj[$i]);
            }else{
                if(empty($orders)){
                    continue;
                }else{
                    for($j = 0; $j < sizeof($orders); $j++){
                        array_push($jsonObj[$i][$relatedModel] , $orders[$j]);
                    }
                }
            }

        }
        return $jsonObj;
    }

    public function hasMany($relatedModel , $foreignKey , $primaryKey = 'id'){
        $json = $this->oneToManyRelation($relatedModel, $foreignKey, $primaryKey)->runSelect();

        $json = $this->NullRelatedModelObj($relatedModel , $json);
        $json = $this->ComposeRelatedModelObject($relatedModel , $json);
        $json = $this->GatherRelatedObjects($relatedModel , $json);
        print_r(json_encode($json));
    }












    //make right join relationship according to the table the has the foreign key
    public function belongsTo($relatedModel , $foreignKey , $primaryKey = 'id'){
        $columns = $this->mergeTwoTableColumns($this->getClass() , $relatedModel);
        $this->sql = $this->sql. $this->select($columns)
                ->rightJoin($relatedModel , $this->joinsTableFormat($this->getClass(),$primaryKey) , $this->joinsTableFormat($relatedModel,$foreignKey))
                ->getQuery();
        return $this;
    }

    //get all columns without alias
    public function getAllColumns($tableName){
        $arr = $this->show($tableName)->runSelect();
        return array_map(function ($value) use ($tableName){
            //$tableName.$value['Field']
            return $tableName.'_'.$value['Field']; //$this->joinsTableFormat($tableName , $value['Field']);
        } , array_values($arr));
    }

    //show all column names from a table
    public function getAllColumnsNameAsAlias($tableName){
        $arr = $this->show($tableName)->runSelect();
        return array_map(function ($value) use ($tableName){
            //$tableName.$value['Field'] as $tableName_$value['field']
            return $this->joinsTableFormat($tableName , $value['Field']).' as '. $tableName . '_' .$value['Field'].' ';
        } , array_values($arr));
    }

    //merge all columns from two tables in joins
    public function mergeTwoTableColumns($table1 , $table2){
        $table1 = $this->getAllColumnsNameAsAlias($table1);
        $table2 = $this->getAllColumnsNameAsAlias($table2);
        return array_merge($table1 , $table2);
    }

}