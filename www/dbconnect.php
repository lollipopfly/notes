<?
$connect = mysql_connect('localhost', 'newyorrker', '');
		$db = mysql_select_db("my_bd");

		print_r($_SESSION['id']);

		if (!$connect || !$db ) {
			exit(mysql_error());
		}
?>