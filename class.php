<?php

class Dates {
	public $num_of_days = 1;
	
	public function DateCompare($date) {
		$date1 = new DateTime();
		$date2 = new DateTime($date);
		$diff=date_diff($date1,$date2);
		return $diff->format("%a");
				
	}
}

class Email {
	public function SendEmail($user, $email) {
		$to = $email;
		$subject = 'This is an email.';
		$headers = 'From: Me <kryfie@gmail.com>';
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message = '<html><body>';
		$message = '<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQQqOQL91KvrEFkWyfPvxtyq7a2U-tEeJ7Qx8sHonSXlDC-BBc-Yg" />';
		$message .= '<h1>Hi <b>'.$user.'</b>,</h1>'."\n\n";
		$message .= '<h2>You are being notified.</h2>';
		

		if (mail($to, $subject, $message, $headers)) {
						echo "Email has been sent!<br>";
					} else {
						echo "Email not sent :(<br>";
					}
	}
}
?>
