<?php

$host_name = "mysql.cba.pl";
$database = "testpage123_cba_pl";
$username = "testdb";
$password = "cbainet";


try {
	$conn = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	
}


?>
