<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf8">
	<title>Мой первый блог</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
	<div class="container">
	    <h1>Мой первый блог</h1>
		    <div>
			<form method="post" action="index.php?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>">
			    <label>
				Название
				<input type="text" name="title" value="<?=$article['title']?>" class="form-item" autofocus required>
			    </label>
			    <label>
				Дата
				<input type="date" name="date" value="<?=$article['date']?>" class="form-item" required>
			    </label>
			    <label>
				Содержимое
				<textarea class="form-item" name="content" required><?=$article['content']?></textarea>
			    </label>
			    <input type="submit" value="Сохранить" class="btn">
			</form>
		    </div>
	    <footer>
	    <p>Мой первый блог <br>
	    Copy right &copy; 2017</p>
	    </footer>
	</div>
    </body>

</html>
