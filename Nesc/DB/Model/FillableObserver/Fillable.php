<?php
namespace DB\Model\FillableObserver;
use Observer\Observer;
use DB\Model\Model;

require ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/Model.php');

class Fillable{

    private $arr = [];
    private static $instance = null;

    private function __construct(){
    }

    public static function createFillable(){
        if(self::$instance === null){
            self::$instance = new Fillable();
        }
        return self::$instance;
    }

    public function addObserver($model){
        $this->arr[count($this->arr)] = [$model->name() => $model->fillable];
    }

    public function removeObserver(Observer $observer){
        unset($this->arr[$observer->name()]);
    }

    public function notifyObserver(){

    }

    public function getFillableList($name){
        return $this->arr[$name];
    }
}