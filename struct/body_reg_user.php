<?php
session_start();

if(empty($_SESSION)) header("Location: ../index.php?loc=main");

?>

    <div class="content">
        <h2>Добро пожаловать, <?=$_SESSION['name'];?>!</h2>
	<table class="table">
	    <tr>
		<th>Имя</th>
		<th>Ник игрока</th>
		<th>Регистрация аккаунта</th>
		<th>Активация на сервере</th>
	    </tr>
	    <tr>
		<td><?=$_SESSION['name']?></td>
		<td><?=$_SESSION['user']?></td>
		<td><?=$_SESSION['date']?></td>
		<td><?php if($_SESSION['activ_date'] == ""){echo "Ожидание активации...";}else{echo $_SESSION['activ_date'];};?></td>
	    </tr>
	</table>
	<a href="../index.php?loc=logout">Выход</a>
    </div>