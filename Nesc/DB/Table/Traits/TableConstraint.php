<?php
namespace DB\Table\Traits;
trait TableConstraint
{
    public function primaryKey(){
        $this->columnProperty = $this->columnProperty.' UNSIGNED AUTO_INCREMENT PRIMARY KEY';
        return $this;
    }

    public function NotNUll(){
        $this->columnProperty = $this->columnProperty.' NOT NULL';
        echo $this->columnProperty;
        return $this;
    }

    public function unique(){
        $this->columnProperty = $this->columnProperty.' UNIQUE';
        return $this;
    }

    public function foreignKey($columnName , $targetTable , $targetId){
        $this->columnProperty = $this->columnProperty.' FOREIGN KEY('.$columnName.') REFERENCES '.$targetTable.'('.$targetId.')';
        return $this;
    }
}