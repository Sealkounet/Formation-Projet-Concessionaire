<?php
session_start();
class Auth {
    static function isLogged(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }
}