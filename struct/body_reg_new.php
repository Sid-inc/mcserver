<!--     <div class="content">
        <form class="new_form" method="post" action="../index.php?loc=reg&form=registration">
	    <fieldset>
	    <legend>Регистрация</legend>
		<h4>Имя*:</h4><input type="text" name="name" value="" autofocus required>
		<h4>Логин*:</h4><input type="text" name="nick" value="" required>
		<h4>Пароль*:</h4><input type="password" name="pass" value="" required><br><br>
		<?php if(isset($_GET['err'])) $errr = $_GET['err']; else $errr = "";
		if($errr == "duble") echo '<p class="warning">Такой логин уже используется<p>';?>
                <input type="submit" value="Регистрация" class="bth">
	    </fieldset>
        </form>    
    </div> -->

	<div class="reg">
	<p id="login">Регистрация</p>
	<form action="../index.php?loc=reg&form=registration" method="post" id="formreg"><br />
	Введите имя*:<br />
	<input type="text" id="name" name="name" maxlength="20" autofocus required></br><br />
	Введите логин*:<br />
	<input type="text" id="log" name="nick" maxlength="20" required></br><br />
	Введите пароль*:<br />
	<input type="password" id="pass" name="pass" maxlength="20" required>
	<?php if(isset($_GET['err'])) $errr = $_GET['err']; else $errr = "";
		if($errr == "duble") echo '<p class="warning">Такой логин уже используется<p>';?>
	<p><input type="submit" value="Регистрация" name="send" id="submit"></p>
	    <div id="hid_reg"></div>
	    </form>
	</div>