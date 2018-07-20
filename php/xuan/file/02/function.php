<?php
    function checkEmty($value){
        $flag = false;
        if(!isset($value) || trim($value) == ""){
            $flag = true;
        }
        return $flag;
    }