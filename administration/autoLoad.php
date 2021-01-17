<?php

spl_autoload_register (function ($className){
    require_once ('class/'.$className.'.class.php');
});