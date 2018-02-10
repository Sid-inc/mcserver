<?php

/**
 * @author Sid 
 * @copyright 2017
 */
require_once("modules/connect.php"); // Модуль подключения к базе
require_once("modules/dbwork.php");
// Модуль работы с базой

include("struct/header.php");
	// Подключение хедера
include("struct/menu.php");
 // Подключение меню
include("struct/counter.php");
// Подключение счетчика сервера

$link = db_connect(); // Подключение к базе

if(isset($_GET['loc']))
 // Выбор страницы для загрузки
    $location = $_GET['loc'];
 else
    $location = "";

if(isset($_GET['form']))
 // Выбор формы авторизации или регистрации
    $form = $_GET['form'];
 else
    $form = "";

if (isset($_GET['actid'])){
	user_change($link, $_GET['actid'], "9");
}
if (isset($_GET['lockid'])){
	user_change($link, $_GET['lockid'], "10");
}



if($location == "main" or $location == ""){
 //Переход на главную
    include("struct/body.php");
    }else if($location == "connect"){
	// Переход на страницу подключения
        include("struct/body_connect.php");
    }else if($location == "reg"){
	// Переход на страницу авторизации или регистрации
    	    if($form == "new"){		// Страница регистрации
		    include("struct/body_reg_new.php");
	    }else if($form == "registration"){	// Добавление нового пользователя в БД
		    user_add($link, $_POST['name'], $_POST['nick'], $_POST['pass']);
	    }else{			// Страница авторизации
		    include("struct/body_reg.php");
		};
    }else if($location == "go"){	// Авторизация
	session_start();
	if(empty($_SESSION)){
	    $data = user_chek($link, $_POST['login'], $_POST['pass']);
	    if($data){			// В случае успешной авторизации переход на личную страницу
		$usr = $data['nick'];
		$_SESSION['user'] = $usr;
		$_SESSION['name'] = $data['name'];
		$_SESSION['date'] = $data['date'];
		$_SESSION['active_date'] = $data['active_date'];
		if($usr == "admin"){
		include("struct/body_reg_admin.php"); // Переход на страницу админа
		}else{
		include("struct/body_reg_user.php"); // Переход на страницу польхователя
		};
	    }else{
		include("struct/body_reg.php");	// В случае неверной авторизации переход на страницу авторизации
		echo '<p class="warning">Неверное имя пользователя или пароль<p>';
	    };
	};
    }else if($location == "admin"){include("struct/body_reg_admin.php");
    }else if($location == "user"){include("struct/body_reg_user.php");
    }else if($location == "logout"){
	session_start();
	unset($_SESSION['user']);
	session_destroy();
	header("Location: index.php?loc=main"); 
    };
include("struct/footer.php");
?>