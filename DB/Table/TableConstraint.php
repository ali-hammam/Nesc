<?php


trait TableConstraint
{
    public function primaryKey(){
        return 'INT UNSIGNED AUTO_INCREMENT PRIMARY KEY';
    }

    public function NotNUll(){
        return 'NOT NULL';
    }

    public function unique(){
        return 'UNIQUE';
    }

    public function foreignKey($columnName , $targetTable , $targetId){
        return 'FOREIGN KEY('.$columnName.') REFERENCES '.$targetTable.'('.$targetId.')';
    }
}