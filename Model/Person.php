<?php
namespace Model;

/*require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/ModelFacade.php');
use DB\Model\ModelFacade;*/

require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/Model.php');
use DB\Model\Model;
class Person extends Model
{

    protected $table = "persons";
    protected $fillable = ['id' , 'firstName'];

    public function orders(){
        return $this->hasMany('orders');
    }

    public function phoneNumber(){
        return $this->hasOne('phonenumbers');
    }
}