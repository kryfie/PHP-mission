<?php
require 'connect_database.php';
require 'class.php';

$query = $handler->query('SELECT `members`,`id`, `date_notification` FROM `members`');

if ($query->rowCount()){
	while($r = $query->fetch(PDO::FETCH_OBJ)) {
		$members = $r->members;
		$user_id = $r->id;
		$date_notification = $r->date_notification;
		echo $members,'<form action="index.php" method="POST"><input type="hidden" name="members" value="'.$members.'">
		<input type="hidden" name="user_id" value="'.$user_id.'"><input type="hidden" name="date_notification" value="'.$date_notification.'">
		<input type="submit" value="Notify"></form><br>';
	}
} else {
	echo "No results.";
}



if (isset($_POST['members']) && isset($_POST['user_id']) && isset($_POST['date_notification'])) {
	$members = $_POST['members'];
	$user_id = $_POST['user_id'];
	$date_notification = $_POST['date_notification'];
	$notified = "Y";
	$diff_dates = new Dates;
	$diff_dates_num = $diff_dates->DateCompare($date_notification);
	$num_of_days = new Dates;
	$days_num = $num_of_days->num_of_days;


	if ($diff_dates_num >= $days_num) {
		$notification_sql = "INSERT INTO notification (notified, member_id, date_notification) VALUES ('$notified', '$user_id', NOW())";
		$handler->query($notification_sql);
		$date_notification_update_sql = "UPDATE members SET date_notification=NOW() WHERE members='$members'";
		$handler->query($date_notification_update_sql);
		echo "SQL updated";
		} else {
		echo "User has been already notified on $date_notification";

		}
	
}

?>
