<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Guest book</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<h2>Сообщения</h2>



<?php
	function form($post, $login = '', $msg = '') {
		if ($post == true) {
			if ($login == '') $login_login = ' введите имя';
			if ($msg == '') $login_msg = ' введите сообщение';
			if (strlen($login) > 20) $login_login = 'не больше 20 знаков';
			if (strlen($msg) > 100) $login_msg = 'не больше 100 знаков';
		}
?>

		<hr>
		<h1>Пример гостевой книги</h1>
		<h2>Оставить отзыв</h2>
		<form class="guestgbook" action="index.php" method="post">
			<div class="form-block name-block">
				<label>Ваше имя</label>
				<input type="text" name="login" value="<?=$login;?>">
				<span><?=$login_login?></span>
			</div>
			<div class="form-block mes-block">
				<label>Ваш отзыв</label>
				<textarea type="text" name="msg"><?=$msg;?></textarea>
				<span><?=$login_msg ?></span>
			</div>

			<button>
				Оставить отзыв
			</button>
		</form>
		<hr>

<?php
	}
	if (!isset($_POST['login'])) {
		$post = false;
		form($post);
	} elseif ($_POST['login'] != '' and $_POST['msg'] != '') {
		
		$login = $_POST['login'];
		$msg = $_POST['msg'];
		$date = date('d-m-Yг. G:i:s');
		$UID = $_SESSION['id'];
		
		require_once("dbconnect.php");
		
		$res = mysql_query("
					INSERT INTO guestbook (uid,date,user,mess) 
					VALUES ('$UID','$date','$login','$msg')");

		if (!$res) {
			exit(mysql_error());
		}
				
		$result = mysql_query(" SELECT * FROM guestbook ");
		while ($row = mysql_fetch_array($result)) {
			?>
			<hr>
			<div class="mes-box">
			<p class="username">
				Пользователь: <?=$row['user']?>
			</p>
			<p class="text">
				Текст сообщения: <?=$row['mess']?>
			</p>
			<p class="date">
				Дата и время: <?=$row['date']?>
			</p>
			</div>

			<?
		}

		mysql_close();
		
		form($post);

	} else {
		$login = $_POST['login'];
		$msg = $_POST['msg'];
		$post = true;
		form($post, $login, $msg);
	}

?>

		
	</div>
	</body>
</html>