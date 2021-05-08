<?php
namespace DB\Model\Traits;

trait Helpers
{

    public function getAllColumnsWithoutEdit($tableName){
        $arr = $this->show($tableName)
                    ->runSelect()
                    ->get();
        return array_map(function ($value) use ($tableName){
            return $value['Field'];
        } , array_values($arr));
    }

    //get all columns without alias like persons_firstName
    public function getAllColumns($tableName){
        $arr = $this->show($tableName)
                    ->runSelect()
                    ->get();
        return array_map(function ($value) use ($tableName){
            //$tableName.$value['Field']
            return $tableName.'_'.$value['Field']; //$this->joinsTableFormat($tableName , $value['Field']);
        } , array_values($arr));
    }

    //show all column names from a table
    public function getAllColumnsNameAsAlias($tableName){
        $arr = $this->show($tableName)
                    ->runSelect()
                    ->get();
        return array_map(function ($value) use ($tableName){
            //$tableName.$value['Field'] as $tableName_$value['field']
            return $this->joinsTableFormat($tableName , $value['Field']).' as '. $tableName . '_' .$value['Field'].' ';
        } , array_values($arr));
    }

    //merge all columns from two tables in joins
    public function mergeMultipleTableColumns(...$tableNames){
        $table = [];
        foreach($tableNames as $tableName){
            $table = array_merge($table , $this->getAllColumnsNameAsAlias($tableName));
        }
        return $table;
    }

    //gather all the desired object format into one array
    protected function oneToManyJson($relatedModel , $jsonObj){
        $columns = $this->getAllColumns($relatedModel);
        $jsonArr = [];
        $temp = [];
        $jsonArrCounter = 0;
        $person_id = -1;


        for($i = 0; $i < sizeof($jsonObj); $i++){
            //gather the same related object to specific primary key
            if($person_id === $jsonObj[$i][$this->table.'_id']){
                for($j = 0; $j < sizeof($columns); $j++){
                    $temp[$columns[$j]] = $jsonObj[$i][$columns[$j]];
                }
                array_push($jsonArr[$jsonArrCounter][$relatedModel] , $temp);
            }else{
                $person_id = $jsonObj[$i][$this->table.'_id'];
                $jsonArr[++$jsonArrCounter] = $this->encapsulateRelatedModel($relatedModel , $jsonObj , $i);
            }
        }
        return $jsonArr;
    }

    //create the desired object format
    private function encapsulateRelatedModel($relatedModel , $jsonObj , $index){
        $jsonArr = [];
        $temp = [];
        $counter = 0;
        $columns = array_merge($this->getAllColumns($this->table) , $this->getAllColumns($relatedModel));


        for($i = 0; $i < sizeof($columns); $i++){
            if(substr($columns[$i] , 0 ,strpos($columns[$i] , '_'))  === $relatedModel){
                // counter is 1 if related Model is null
                if($counter === 1){
                    break;
                }else if($jsonObj[$index][$columns[$i]] === null){
                    $temp = null;
                    $counter++;
                }else {
                    //get related columns
                    $temp[$columns[$i]] = $jsonObj[$index][$columns[$i]];
                }
            }else {
                $jsonArr[$columns[$i]] = $jsonObj[$index][$columns[$i]];
            }
        }


        is_array($temp) === true ? $jsonArr[$relatedModel] = [$temp]: $jsonArr[$relatedModel] = $temp;
        return $jsonArr;
    }

    //put default foreign key convention $tableId
    public function putDefaultForeignKey($foreignKey = null){
        if($foreignKey === null){
            $foreignKey = $this->table.'Id';
        }
        return $foreignKey;
    }


}