<?php
require 'connect.inc.php';

$query = "SELECT `members` FROM `members`";

if ($query_run = mysql_query($query)) {

	if (mysql_num_rows($query_run)==NULL) { //if no rows in SQL, echo out: "No results found" message
		echo 'No results found.';
	} else {

		while ($query_row = mysql_fetch_assoc($query_run)) { //fetching data from SQL to an array
			$members = $query_row['members'];
			
			echo $members.'<form action="index.php" method="POST"><input type="hidden" name="members" value="'.$members.'"><input type="submit" value="Notify"></form><br>';
		}
	}
}


if (isset($_POST['members'])) {
	$members = $_POST['members'];

	if (!empty($members)) {
		$query = "SELECT `id` FROM `members` WHERE `members`='$members'";
		if ($query_run = mysql_query($query)) {
			$user_id = mysql_result($query_run, 0, 'id');
			$notified = "Y";
			$query = "SELECT `member_id` FROM `notification` WHERE `member_id` = '$user_id'";
			$query_run = mysql_query($query);
			if (mysql_num_rows($query_row==1)) {
				echo "User already notified";
				} else {
				$query = "INSERT INTO `notification` VALUES ('', '$notified', $user_id)";
				$query_run = mysql_query($query);
				echo "User has been notified.";
			}
			

		}	
	}
}

?>
