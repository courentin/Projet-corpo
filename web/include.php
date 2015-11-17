<?php
spl_autoload_register('autoload');

function autoload($class){
    require "app/$class.php";
}
