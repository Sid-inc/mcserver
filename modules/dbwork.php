<?php


function user_add($link, $name, $nick, $pass){
    // Регистрация новго пользователя
    $name = trim($name);
    $nick = trim($nick);
    $pass = md5(trim($pass));
    $date = date('YmdHis');
    $state = '0';

    if ($name == '') 
	return false;
    // Проверка совпадения имен
    $c = "SELECT * FROM users WHERE nick='%s'";
    $query_chek = sprintf($c, mysqli_real_escape_string($link, $nick));
    $chek = mysqli_query($link, $query_chek);
    if(mysqli_num_rows($chek) <> 0){
	header("Location: index.php?loc=reg&form=new&err=duble");
	return false;
    }else{
	// Добавление нового пользователя
	    $t = "INSERT INTO users (name, nick, pass, date, aktiv_state) VALUES ('%s', '%s', '%s', '%s', '%s')";
	    $query = sprintf($t, mysqli_real_escape_string($link, $name), 
			 mysqli_real_escape_string($link, $nick), 
			 mysqli_real_escape_string($link, $pass),
			 mysqli_real_escape_string($link, $date),
			 mysqli_real_escape_string($link, $state)
	    		    );
	    $result = mysqli_query($link, $query);
	    if (!result)
		die(mysqli_error($link));
    	    header("Location: index.php?loc=reg");
    	    return true;
	};
};

function user_chek($link, $login, $pass){
    //Проверка имени пользователя и пароля для авторизации
    $login = trim($login);
    $pass = trim ($pass);
    $pass = md5($pass);

    if($login == '')
	return false;

    $t = "SELECT * FROM users WHERE nick='%s'";
    $query = sprintf($t, mysqli_real_escape_string($link, $login));

    $result = mysqli_query($link, $query);

    if (!$result)
	die(mysqli_error($link));
    
    $gett = mysqli_fetch_assoc($result);
    
    if($gett['nick'] == $login AND $gett['pass'] == $pass){
	    return $gett;
    } else return false;

}

function all_users($link){
    $query = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($link, $query);

    if (!$result)
	die(mysqli_error($link));

    $n = mysqli_num_rows($result);
    $allusers = array();

    for ($i = 0; $i < $n; $i++)
    {
	$row = mysqli_fetch_assoc($result);
	$allusers[] = $row;
    };
    return $allusers;

}

function user_change($link, $id, $act){

    if($id == '')
	return false;
    $id = (int)$id;
    $act = (int)$act;
    $t = "UPDATE users SET aktiv_state='%d' WHERE id='%d'";
    $query = sprintf($t, $act, $id);
    $result = mysqli_query($link, $query);
    if (!$result)
	die(mysqli_error($link));
    return mysqli_affected_rows($link);

}
//function articles_edit($link, $id, $title, $date, $content){
//
//    $title = trim($title);
//    $content = trim($content);
//    $date = trim($date);
//    $id = (int)$id;
//
//    if ($title == '')
//	return false;
//    
//    $sql = "UPDATE articles SET title='%s', content='%s', date='%s' WHERE id='%d'";
//
//    $query = sprintf($sql, mysqli_real_escape_string($link, $title),
//			    mysqli_real_escape_string($link, $content),
//			    mysqli_real_escape_string($link, $date),
//			    $id);
//
//    $result = mysqli_query($link, $query);
//
//    if (!result)
//	die(mysqli_error($link));
//    
//    return mysqli_affected_rows($link);
//}

//function articles_delete($link, $id){
//    $id = (int)$id;
//    if ($id == 0)
//	return false;
//    $query = sprintf("DELETE FROM articles WHERE id='%d'", $id);
//    $result = mysqli_query($link, $query);
//    if (!$result)
//	die(mysqli_error($link));
//    return mysqli_affected_rows($link);
//}

//function articles_intro($text, $len = 500){
//    return substr($text, 0, $len);
//}

?>