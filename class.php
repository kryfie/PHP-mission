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

?>
