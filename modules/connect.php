<?php

define('SERVER', 'localhost');
define('USER', 'mcsrv');
define('PASS', '159357');
define('DB', 'mcserver');

function db_connect(){
    $link = mysqli_connect(SERVER, USER, PASS, DB) or die("Error: ".mysqli_error($link));
    if(!mysqli_set_charset($link, "utf8")){
        printf("Error: ".mysqli_error($link));
    }
    return $link;
}
    
?>