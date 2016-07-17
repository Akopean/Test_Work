<?php
session_start();
//init config
$config = require(__DIR__ .'/config/config.php');
require(__DIR__ . '/app/Route.php');
//check language
if(isset($_COOKIE['lang']))
{
    $lang = $_COOKIE['lang']=='En' ? 'En' : 'Ru';
    setcookie ("lang", "", 0);
    setcookie ("lang", $lang, time()+(60*60*24*30));
}
else
{
    $lang = 'En';
}

$_SESSION['lang'] = $lang;
$config['lang'] = $lang;
//init Route
Route::Run($config);
