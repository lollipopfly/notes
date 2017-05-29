<?
$connect = mysql_connect('localhost', 'newyorrker', '');
		$db = mysql_select_db("my_bd");

		if (!$connect || !$db ) {
			exit(mysql_error());
		}
?>