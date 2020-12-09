<?php

function validate($value, $type){
    //type 1 must be alphabetic
    //type 2 must be numeric
    if($type == 1) {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
            return false;
        }
    }
    else if($type == 2){
        if(!is_numeric($value)){
            return false;
        }
    }

    return true;
}

function validateEmail($email){

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
    }

    return true;
}