<?php

spl_autoload_register(function($class){
    //echo $class;
    $path = $_SERVER["DOCUMENT_ROOT"]."/Matcha";
    $extension = "";
    if ($class == "DB")
    {
        $path .= "/config/";
        $extension = ".php";
        $class ="database";
    }
    else
    {
        $path .="/classes/";
        if ($class == "Element")
            $extension = ".php";
        else
            $extension = ".class.php";
    }
    
    require_once $path.$class.$extension;
});
?>
