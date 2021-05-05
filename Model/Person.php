<?php
namespace Model;
use DB\Model\Model;
require_once ('../Nesc/DB/Model/Model.php');

class Person extends Model
{
    protected $table = "persons";
    public function order(){
        return $this->hasMany('orders' , 'personsId');
    }
}