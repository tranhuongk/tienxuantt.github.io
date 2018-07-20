<?php
session_start();

if(isset($_SESSION)){
    foreach($_SESSION as $key => $value){
        $ses = unserialize($value);
        echo "<pre>";
        print_r($ses);
        echo "</pre>";
    }
}else{
    echo "error";
}

