<?php
error_reporting(E_ALL);
// error_reporting(0);

// require_once('Session.php');
require_once('Constant.php');
require_once('DBConfig.php');
require_once('Function.php');

function __autoload($class_name){
    $file_name = BASE_PATH .'class/'. $class_name .'.php';

    if( file_exists($file_name) && is_file($file_name) ){
        require_once($file_name);
    }
}

?>
