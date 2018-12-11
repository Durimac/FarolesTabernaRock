<?php
	// Fisrt get the actual date (today) and the days of the month (30 or 31)
	$today = date('d');
	$month = date('m');
	$year = date('Y');
	$daysOfMonth = date('t');

	// We get all the information of the first day of the month. First its milliseconds, then all the info as a Date
	$firstDay_Miliseconds = mktime(0, 0, 0, $month, 1, $year);
	$firstDay_AllInfo = getdate($firstDay_Miliseconds);

	// We get the WeekDay from that first day
	$firstDay_WeekDay = $firstDay_AllInfo['wday'];

	echo "<table border='1'>";
	echo "<tr>";
	echo "<th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th>";
	echo "</tr>";

	// We need a counter to track the day we are printing
	$day = 1;

	// We print null spaces if the first day of the month is not Monday
	echo "<tr>";
	for($i = 1 ; $i < $firstDay_WeekDay ; $i++) {
		echo "<td>&nbsp;</td>";
	}

	// Start printing real days
	for($i = $firstDay_WeekDay ; $i < 8 ; $i++) {
		echo "<td id='calendar_{$day}'>" . $day . "</td>";
		$day++;
	}
	echo "</tr>";

	// We calculate the weeks that are left till the end of the month
	$weeksLeft = ceil(($daysOfMonth-$day+1)/7);

	// We finish printing all the rest of the days
	for($i = 1 ; $i <= $weeksLeft ; $i++) {
		echo "<tr>";
		for($j = 1 ; $j <8 ; $j++)
		{
			if($day > $daysOfMonth) {
				echo "<td>&nbsp;</td>";
			}
			else {
				echo "<td id='calendar_{$day}'>".$day."</td>";
				$day++;
			}
		}
		echo "</tr>";	
	}
	echo "</table>";
?>