<?php
namespace Model;
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/Model.php');
use DB\Model\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id' , 'orderName' , 'personsId'];

    public function person(){
        return $this->belongsTo('persons');
    }

    public function items(){
        return $this->hasManyThrough('items');
    }
}