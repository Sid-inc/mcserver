<?php
session_start();

if($_SESSION['user'] <> "admin"){
    header("Location: ../index.php?loc=main");
    }else{
	$allusers = all_users($link);
    };
//if(isset($_GET['actid'])){
//	user_change($link, $_GET['actid'], "9");
//}
//if(isset($_GET['lockid'])){
//	$uid = $_GET['lockid'];
//	user_change($link, $uid, "10");
//}

?>

    <div class="content">
        <h2>Добро пожаловать, <?=$_SESSION['name'];?>!</h2>
	<table class="table">
	    <tr>
		<th>ID</th>
		<th>Имя</th>
		<th>Ник игрока</th>
		<th>Регистрация аккаунта</th>
		<th>Активация на сервере</th>
		<th>Статус активации</th>
		<th>Заблокировать</th>
	    </tr>
	    <?php foreach($allusers as $a){ ?>
	    <tr>
		<td><?=$a['id'];?></td>
		<td><?=$a['name'];?></td>
		<td><?=$a['nick'];?></td>
		<td><?=$a['date'];?></td>
		<td><?php if($a['aktiv_date'] == ""){echo "Ожидание активации...";}else{echo $a['aktiv_date'];};?></td>
		<td><?=$a['aktiv_state'];?></td>
		<td>
		<a href="index.php?loc=admin&<?php if($a['aktiv_state'] == "10"){
			echo "actid=".$a['id'].'">Разблокировать';
			}else{echo "lockid=".$a['id'].'">Заблокировать';}
		?></a>
		
		</td>
	    </tr>
	    <?php }; ?>
    </table>
	<a href="index.php?loc=logout">Выход</a>
    </div>