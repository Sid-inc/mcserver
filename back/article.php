<?php
    require_once("database.php");
    require_once("modules/articles.php");

    $link = db_connect();
    $article = articles_get($link, $_GET['id']);
    
//    var_dump($article);

    include("views/article.php");

?>
