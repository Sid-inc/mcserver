<?php

define('SERVER', 'localhost');
define('USER', 'sveta');
define('PASS', '123');
define('DB', 'minecraft');

function db_connect(){
    $link = mysqli_connect(SERVER, USER, PASS, DB) or die("Error: ".mysqli_error($link));
    if(!mysqli_set_charset($link, "utf8")){
        printf("Error: ".mysqli_error($link));
    }
    return $link;
}
    
?>