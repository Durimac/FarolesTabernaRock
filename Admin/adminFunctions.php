<?php
	session_start();
	if(@$_SESSION['privilege'] != 1) {
		exit();
	}
	if(isset($_GET['action'])) {
		switch($_GET['action']) {
			// Function to close the Sesion of Admin User
			case "closeSesion":
				//echo "session destroyed";
				session_destroy();
				break;
		}
	}
	else {
		exit();
	}
?>