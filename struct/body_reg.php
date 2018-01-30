<?php
session_start();

if(!empty($_SESSION)){
    if($_SESSION['user'] == "admin"){
	header("Location: index.php?loc=admin");
	exit;
    }else{ header("Location: index.php?loc=user");
	exit;
	};
};

?>
<!--     <div class="content">
        <form class="auth_form" method="post" action="index.php?loc=go">
	    <fieldset>
	    <legend>Вход</legend>
		<h4>Логин:</h4><input type="text" name="login" value="" autofocus required>
		<h4>Пароль:</h4><input type="password" name="pass" value="" required><br><br>
                <input type="submit" value="Войти" class="bth">
	    </fieldset>
        </form>    
	<form class="auth_form" method="post" action="../wpru/index.php?loc=reg&form=new">
	<input type="submit" value="Регистрация" class="bth">
	</form>
    </div> -->

<div class="reg">
	<form action="index.php?loc=go" method="post" id="formauth"><br />
	<p id="login">Вход</p>
	Введите логин: <br />
	<input type="text" id="logi" name="login" maxlength="12"/><br /><br />
	Введите пароль: <br />
	<input type="password" id="logi" maxlength="12"/><br /><br />
	<input type="submit" class="reg-link" name="pass" value="Авторизация" id="auth">
	<div id="hid_auth"></div>
	</form>
	<form class="auth_form reg_link" method="post" action="index.php?loc=reg&form=new">
	<input type="submit" value="Регистрация" class="bth">
	</form>
	
</div>