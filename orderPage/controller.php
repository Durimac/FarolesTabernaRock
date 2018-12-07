<?php
//$hostDB="vulcano.tel.uva.es";
//$loginDB="taw010";
//$passDB="3eo0u4b9";
$hostDB="localhost";
$loginDB="root";
$passDB="";
$nameDB="FarolesTabernaRock";

// @ $db=mysql_pconnect($hostDB, $loginDB, $passDB);
@ $db = mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
if(!$db) {
	/* Dario's parammeters for the MySQL server. Otherwise it will not work for me (Darío) */
	$hostDB="127.0.0.1";
	$passDB="root";
	@ $db = mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
	if(!$db) {
		echo "No fue posible conectarse con la base de Datos " .  $db->connect_error();
		exit();
	}
}

/* We get the kinds of food that are stored in the data base */
$menuKinds = get_MenuKinds($db);
$foodKindsList = array();
/* After getting the food kinds, we fill a matrix with each kind of food and its own products List */
foreach($menuKinds as $index => $column) {
	$foodKindsList[] = array('kind' => $column, 'productsList' => get_FoodFromKind($db, $menuKinds[$index]));
}

/* We close the connection with the DB */
$db->close();


/* Function for getting the kinds of food that are stored in the DB */
function get_MenuKinds($db) {
	$query_GetKinds = "SELECT kind FROM food";
	$result_GetKinds = $db->query($query_GetKinds);
	
	if ($result_GetKinds->num_rows > 0) {
		$differentKinds = array();
		// output data of each row
		while($row = $result_GetKinds->fetch_assoc()) {
			if(!in_array($row['kind'], $differentKinds)) {
				$differentKinds[] = $row['kind'];
			}
		}
		return $differentKinds;
	} 
	else {
		echo "0 results";
	}
}

/* Function for getting the products list of each kind of food that are stored in the DB */
function get_FoodFromKind($db, $kind) {
	$query_GetFoods = "SELECT * FROM food WHERE kind='$kind'";
	$result_GetFoods = $db->query($query_GetFoods);

	if($result_GetFoods->num_rows > 0) {
		$foodFromKind = array();
		while($row = $result_GetFoods->fetch_assoc()) {
			$foodFromKind[] = $row;
		}

		return $foodFromKind;
	}
	else {
		echo "0 results";
	}
}
?>