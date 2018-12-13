<?php include("../MySQL/mysqliFunctions.php"); ?>
<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/Azahar.php" />
                </head>
                <body>
                    <h1>No tienes permiso para ver esta página</h1>
                    <h2>Primero has de logearte en el sistema como Admin. Redireccionando...</h2>
                </body>
            </html>
        ';
        exit();
    }
?>

<html>
	<head>
		<meta http-equiv='refresh' content='10;url=../penistas/penistas.php' />
		<meta charset="UTF-8" />
		<title>Introducción	de Peñistas</title>
	</head>
	<body>
		<h3>Resultado de la Introducción de Peñista</h3>
		<a href="../penistas/penistas.php">Toque para volver a Peñistas.</a>
		<p>La página se redireccionará automaticamente en 10 segundos</p>
</html>

<?php
	@ $penista_name=$_POST['firstname'];
	@ $penista_surname=$_POST['lastname'];
	@ $penista_email=$_POST['email'];
	@ $penista_phone=$_POST['phone_number'];
	@ $penista_age=$_POST['birthDate'];
	@ $clothes=$_POST['Clothes'];
	@ $clothes_size=$_POST['size'];
	
	$penista_name = normalizeData($penista_name);
	$penista_surname = normalizeData($penista_surname);
	$penista_email = normalizeData($penista_email);
	$penista_phone = normalizeData($penista_phone);
	$penista_age = normalizeData($penista_age);
	$clothes = normalizeData($clothes);
	$clothes_size = normalizeData($clothes_size);
	
	if	(!$penista_name	||	!$penista_email ||	!$penista_phone	||	!$penista_age) {
		echo "No	ha	introducido	toda	la	información	requerida	para	el	cliente.	<br>"
				."Por	favor,	vuelva	a	la	página	anterior	e	inténtelo	de	nuevo."; 
		exit(); 
	}

	if ($clothes=='No') {
		$clothes_size=NULL;
	}
				
	$allowedCharacters = "aáäàâbcçdeéëèêfghiíïìîjklmnoóöòôpqrstuúüùûvwxyzAÁÄÀÂBCÇDEÉËÈÊFGHIJKLMNOÓÖÒÔPQRSTUÚÜÙÛVWXYZ-_'\\";
	
	$array_name = explode(' ',$penista_name);
	$num = count($array_name);
	
	for ($i = 0 ; $i < $num ; $i++) {
		for ($j = 0 ; $j < strlen($array_name[$i]) ; $j++) {
			if (strpos($allowedCharacters, substr($array_name[$i], $j, 1)) === false) {
				echo strpos($allowedCharacters, substr($array_name[$i], $j, 1));
				echo $array_name[$i] . " no es válido<br>";
				exit();
			}
		} 
	}
	
	$array_surname = explode(' ',$penista_surname);
	$num = count($array_surname);
	
	for ($i = 0 ; $i < $num ; $i++) {
		for ($j = 0 ; $j < strlen($array_surname[$i]) ; $j++) {
			if (strpos($allowedCharacters, substr($array_surname[$i], $j, 1)) === false) {
				echo strpos($allowedCharacters, substr($array_surname[$i], $j, 1));
				echo $array_surname[$i] . " no es válido<br>";
				exit();
			}
		} 
	}
	
	
	if ((!ctype_digit($penista_phone)) || (strlen($penista_phone) != 9)) {
		echo	'Debe introducir un número de 9 dígitos';
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
		echo 'Introduzca una fecha de nacimiento verídica1';
		exit();
	}
	
	if(($penista_month > 12) || ($penista_month < 0) ) {
		echo 'Introduzca una fecha de nacimiento verídica2'.$penista_month;
		exit();
	}
	
	if(($penista_day > 31) || ($penista_day < 0) ) {
		echo 'Introduzca una fecha de nacimiento verídica3';
		exit();
	}
	
	if(($year - $penista_year) > 120) {
		echo 'Introduzca una fecha de nacimiento verídica4';
		exit();
	}
	
	
	if(($year - $penista_year) < 18) {
		echo 'Para ser peñista debe ser mayor de edad';
		exit();
	}
	else if(($year - $penista_year) == 18) {
		if($penista_month > $month) {
			echo 'Para ser peñista debe ser mayor de edad';
			exit();
		}
		else if($penista_month == $month) {
			if($penista_day > $day) {
				echo 'Para ser peñista debe ser mayor de edad';
				exit();
			}
		}
	}
	
	if (!(filter_var($penista_email, FILTER_VALIDATE_EMAIL)))  {
		echo "Esta dirección de correo ($penista_email) no es válida.";
	}	
		
	$db = connectDB();
	
	$query1		=	"select penista_name, penista_surname from penista";	
	$repetidos =	mysqli_query($db,$query1);
	$num = mysqli_num_rows($repetidos);
	for ($i=0; $i<$num; $i++)
	{
		$fila = mysqli_fetch_array($repetidos);
		if (($fila['penista_name'] == $penista_name) && ($fila['penista_surname'] == $penista_surname))
		{
			echo "<script type=\"text/javascript\">alert(\"Vaya, parece que este usuario ya está registrado\");</script>";
			echo "<script type=\"text/javascript\">location.href = 'form.html';</script>";
			exit();
		}
	}
	$query	=	"insert	into penista values	
					(NULL,	'".	$clothes	."',	'".	$clothes_size	."',	'".	$penista_name	."',	'".	$penista_surname	."',	'"	.	$penista_email	."',  '"	.	$penista_phone	."',  '"	.	$penista_age	."', NULL )";	
	$resultado	=	mysqli_query($db,	$query);
	
	echo "<script type=\"text/javascript\">alert(\"Peñista registrado con éxito\"); closeWindow();</script>";
	
	mysqli_close($db);
?>
</body>
</html>