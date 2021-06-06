<?php
namespace Model;
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/Model.php');
use DB\Model\Model;

class Item extends Model
{
    protected $table = 'items';

    public function orders(){
        return $this->belongsToMany('orders');
    }
}