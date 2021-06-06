<?php
//error_reporting (E_ALL ^ E_NOTICE);
include ($_SERVER['DOCUMENT_ROOT'].'/nesc/Nesc/Router/Route.php');
use Nesc\Router\Route;

Route::get('/about' , function (){
    print_r(json_encode(['aaa' => 'bbbb' , 'cccc' => 'ddd']));
});

Route::get('/ali' , function (){
    echo 'ali ';
});

Route::get('/conn' , 'example@hi');

Route::get('/eco/1' , 'example@display');

Route::get('/user' , 'User/UserTest@hello');

Route::get('/fuck' , 'User/Test/Test@fuck');

Route::post('/person/insert' , 'example@insertPerson');
