<?php
namespace Commands;

interface Command
{
    public function execute($type , $fileName = null);
}