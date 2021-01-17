<?php
session_start();
require_once ('class/Auth.class.php');
if(Auth::isLogged()){
    header('location:listVehicules.php');
}else{
    header('location:index.php');   
}
