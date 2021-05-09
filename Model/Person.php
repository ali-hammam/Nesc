<?php
namespace Model;
use DB\Model\Model;
require_once ('../Nesc/DB/Model/Model.php');

class Person extends Model
{

    protected $table = "persons";
    protected $fillable = ['id' , 'firstName'];

    public function orders(){
        return $this->hasMany('orders');
    }
}