<?php
namespace Model;
/*use DB\Model\ModelFacade;
require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/ModelFacade.php');*/

require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/Model.php');
use DB\Model\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id' , 'orderName' , 'personsId'];

    public function person(){
        return $this->belongsTo('persons');
    }
}