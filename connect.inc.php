<?php
$conn_error = 'Could not connect.';

$mysql_host = 'mysql.cba.pl';
$mysql_user = 'testdb';
$mysql_pass = 'cbainet';

$mysql_db = 'testpage123_cba_pl';

if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_db)) {
	die($conn_error);
}

?>
