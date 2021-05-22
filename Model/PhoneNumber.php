<?php


namespace Model;
/*require_once ('../Nesc/DB/Model/ModelFacade.php');
use DB\Model\ModelFacade;*/

require_once ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/DB/Model/Model.php');
use DB\Model\Model;

class PhoneNumber extends Model{

    protected $table = "phonenumbers";
    protected $fillable = ['id' , 'phoneNumber' , 'personsId'];

    public function person(){
        return $this->belongsTo('persons');
    }
}