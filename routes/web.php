<?php
error_reporting (E_ALL ^ E_NOTICE);
include ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/Router/Route.php');
use Nesc\Router\Route;

Route::instance();

Route::get('/about' , function (){
    print_r(json_encode(['aaa' => 'bbbb' , 'cccc' => 'ddd']));
});

Route::get('/ali' , function (){
    echo 'ali ';
});

Route::get('/test' , function (){
    echo 'test';
});
