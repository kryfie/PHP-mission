<?php
require 'connect_database.php';
require 'class.php';

$sql = "SELECT members , id, date_notification FROM members";
$query = $conn->prepare($sql);

$query->execute(array());

echo '<form action="index.php" method="POST">';

if ($query->rowCount()) {
	while($r = $query->fetch(PDO::FETCH_OBJ)) {
		$members = $r->members;
		$user_id = $r->id;
		$date_notification = $r->date_notification;
		echo '<input type="checkbox" name="user_id[]" value="'.$user_id.'">', $members.' ('.$date_notification.')<br>';
		
	}
} else {
	echo "No results.";
}

echo '<input type="submit" value="Notify"></form>';

if (isset($_POST['user_id'])) {
	$user_id = $_POST['user_id'];
	foreach($user_id as $element)  {
		$sql = "SELECT members, email_address, date_notification FROM members WHERE id = $element";
		$query = $conn->prepare($sql);
		$query->execute(array());

		if($query->rowCount()) {
			while($r = $query->fetch(PDO::FETCH_OBJ)) {
				$members = $r->members;
				$email = $r->email_address;
				$date_notification = $r->date_notification;
				
				$diff_dates = new Dates;
				$diff_dates_num = $diff_dates->DateCompare($date_notification);
				$num_of_days = new Dates;
				$days_num = $num_of_days->num_of_days;

				if ($diff_dates_num >= $days_num) {

					$new_mail = new Email;
					$new_mail->SendEmail($members, $email);
		
					$date_notification_update_sql = "UPDATE members SET date_notification=NOW() WHERE members= :members";
					$query2 = $conn->prepare($date_notification_update_sql);

					$query2->execute(array(
						':members' => $members
						));
					echo 'User <strong>'.$members.'</strong> has been notified successfully.<br> Previous notification was sent on <b>'.$date_notification.'</b><br>';
					
				} else {
				echo 'User <strong>'.$members.'</strong> has been already notified on <strong>'.$date_notification.'</strong><br> Next notification will be sent in <b>'.$days_num. '</b> day(s).<br>';

					}
			}
		}else {
			echo "No results.";
		}
					

	}
	

}else{
	echo "Select the users you would like to notify!";
}




?>
