<?php include("../../MySQL/mysqliFunctions.php"); ?>
<?php
	session_start();
	if(@$_SESSION['privilege'] != 1) {
		echo 'No tiene permiso para acceder a esta p&aacute;gina';
		exit();
	}
?>
<html>

<head>

	<meta charset="UTF-8" />
		<title>Actualización	de Peñistas</title>
</head>
<body>
<h3>Resultado	de	la	Actualización	de	Peñistas</h3>
<?php
	@	$penista_name = $_POST['firstname'];
	@	$penista_surname = $_POST['lastname'];
	@	$penista_email = $_POST['email'];
	@	$penista_phone = $_POST['phone_number'];
	@	$penista_age = $_POST['birthDate'];
	@	$clothes = $_POST['Clothes'];
	@	$clothes_size = $_POST['size'];

	$penista_name =	normalizeData($penista_name);
	$penista_surname = normalizeData($penista_surname);
	$penista_email = normalizeData($penista_email);
	$penista_phone = normalizeData($penista_phone);
	$penista_age = normalizeData($penista_age);
	$clothes = normalizeData($clothes);
	$clothes_size = normalizeData($clothes_size);
	
	if(!$penista_name || !$penista_email || !$penista_phone || !$penista_age) {
		echo "<script type=\"text/javascript\">alert('Rellene todos los campos por favor')</script>";
		exit();
	}
		
	$allowedCharacters = "aáäàâbcçdeéëèêfghiíïìîjklmnoóöòôpqrstuúüùûvwxyzAÁÄÀÂBCÇDEÉËÈÊFGHIJKLMNOÓÖÒÔPQRSTUÚÜÙÛVWXYZ-_'\\";
	
	$array_name = explode(' ',$penista_name);
	$num = count($array_name);
	
	for ($i = 0 ; $i < $num ; $i++) {
		for ($j = 0 ; $j < strlen($array_name[$i]) ; $j++) {
			if (strpos($allowedCharacters, substr($array_name[$i], $j, 1)) === false) {
				echo "<script type=\"text/javascript\">alert('Introduzca un nombre válido por favor. ".$array_name[$i]." no es válido')</script>";
				exit;
			}
		} 
	}
	
	$array_surname = explode(' ',$penista_surname);
	$num = count($array_surname);
	
	for ($i = 0 ; $i < $num ; $i++) {
		for ($j = 0; $j < strlen($array_surname[$i]); $j++) {
			if (strpos($allowedCharacters, substr($array_surname[$i], $j, 1)) === false) {
				echo "<script type=\"text/javascript\">alert('Introduzca un apellido válido por favor. ".$array_surname[$i]." no es válido')</script>";
				exit;
			}
		} 
	}
	
	
	if ((!ctype_digit($penista_phone)) || (strlen($penista_phone)!= 9)) {
		echo "<script type=\"text/javascript\">alert('Introduzca un número de 9 dígitos.')</script>";
		exit();
	}
	
	$day = date('d');
	$month = date('m');
	$year = date('Y');
	
	$array_age = explode('-',$penista_age);
	$penista_year = $array_age[0];
	$penista_month = $array_age[1];
	$penista_day = $array_age[2];

	if($penista_year > $year) {
		echo "<script type=\"text/javascript\">alert('Introduzca una fecha verídica')</script>";
		exit();
	}
	
	if(($penista_month > 12) || ($penista_month < 0) ) {
		echo "<script type=\"text/javascript\">alert('Introduzca una fecha verídica')</script>";
		exit();
	}
	
	if(($penista_day > 31) || ($penista_day < 0) ) {
		echo "<script type=\"text/javascript\">alert('Introduzca una fecha verídica')</script>";
		exit();
	}
	
	if(($year - $penista_year) > 120) {
		echo "<script type=\"text/javascript\">alert('¿Es usted un poco viejete no?')</script>";
		exit();
	}
	
	
	if(($year - $penista_year) < 18) {
		echo "<script type=\"text/javascript\">alert('Debe ser mayor de edad para ser peñista')</script>";
		exit();
	}
	else if(($year - $penista_year) == 18) {
		if($penista_month > $month) {
			echo "<script type=\"text/javascript\">alert('Debe ser mayor de edad para ser peñista')</script>";
			exit();
		}
		else if($penista_month == $month) {
			if($penista_day > $day) {
				echo "<script type=\"text/javascript\">alert('Debe ser mayor de edad para ser peñista')</script>";
				exit();
			}
		}
	}
	
	if (!(filter_var($penista_email, FILTER_VALIDATE_EMAIL))) {
		echo "<script type=\"text/javascript\">alert('Dirección de correo no es valida')</script>";
	}

	$db = connectDB();
	
	$query = "UPDATE penista SET	
					clothes= '".	$clothes	."', clothes_size=	'".	$clothes_size	."', penista_name=	'".	$penista_name	."', penista_surname=	'".	$penista_surname	."', penista_email=	'"	.	$penista_email	."', penista_phone=  '"	.	$penista_phone	."', penista_age= '"	.	$penista_age	."'
                    WHERE id_penista=".$_SESSION['id_penista'] ;	
	$resultado = mysqli_query($db, $query);

	if($db->error) {
		echo "Ha ocurrido un error al intentar modificar el Peñista: " . $db->error;
	}
	else {
		echo "<script type=\"text/javascript\">alert(\"Peñista registrado correctamente\");</script>";
	}

	mysqli_close($db);
?>
</body>
</html>