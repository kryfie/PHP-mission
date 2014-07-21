<?php

$host_name = "mysql.cba.pl";
$database = "testpage123_cba_pl";
$username = "testdb";
$password = "cbainet";


try {
	$handler = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}


?>
