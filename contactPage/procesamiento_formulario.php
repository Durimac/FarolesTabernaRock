<html>

<head>

	<meta charset="UTF-8" />
		<title>Introducción	de Penistas</title>
</head>
<body>
<h3>Resultado	de	la	Introducción	de	Clientes</h3>
<?php
@	$penista_name=$_POST['firstname'];
@	$penista_surname=$_POST['lastname'];
@	$penista_email=$_POST['email'];
@	$penista_telephone=$_POST['phone_number'];
@	$penista_age=$_POST['birthDate'];
@	$clothes=$_POST['Clothes'];
@	$clothes_size=$_POST['size'];

	$penista_name	=	trim($penista_name);
	$penista_surname	=	trim($penista_surname);
	$penista_email	=	trim($penista_email);
	$penista_telephone	=	trim($penista_telephone);
	$penista_age	=	trim($penista_age);
	$clothes	=	trim($clothes);
	$clothes_size	=	trim($clothes_size);
	
	if	(!$penista_name	||	!$penista_email ||	!$penista_telephone	||	!$penista_age)
	{
		echo "No	ha	introducido	toda	la	información	requerida	para	el	cliente.	<br>"
				."Por	favor,	vuelva	a	la	página	anterior	e	inténtelo	de	nuevo."; 
		exit(); 
	}
		
	$penista_name	=	addslashes($penista_name);
	$penista_surname	=	addslashes($penista_surname);
	$penista_email	=	addslashes($penista_email);
	$penista_telephone	=	addslashes($penista_telephone);
	$penista_age	=	addslashes($penista_age);
	$clothes	=	addslashes($clothes);
	$clothes_size	=	addslashes($clothes_size);
	
		
	$permitidos = "aáäàâbcçdeéëèêfghiíïìîjklmnoóöòôpqrstuúüùûvwxyzAÁÄÀÂBCÇDEÉËÈÊFGHIJKLMNOÓÖÒÔPQRSTUÚÜÙÛVWXYZ-_'\\";
	//echo $penista_name;
	for ($i=0; $i<strlen($penista_name); $i++)
	{
		//echo substr($penista_name,$i,1);
		if (strpos($permitidos, substr($penista_name,$i,1))===false)
		{
			echo substr($penista_name,$i,1);
			echo $penista_name . " no es válido<br>";
			exit;
		}
    } 
	
	$array_surname = explode(' ',$penista_surname);
	$num = count($array_surname);
	
	for ($i = 0; $i < $num; $i++)
	{
		
		for ($j = 0; $j < strlen($array_surname[$i]); $j++)
		{
			if (strpos($permitidos, substr($array_surname[$i],$j,1))===false)
			{
				echo strpos($permitidos, substr($array_surname[$i],$j,1));
				echo $array_surname[$i] . " no es válido<br>";
				exit;
			}
		} 
	}
	
	
	if ((!ctype_digit($penista_telephone)) | (strlen($penista_telephone)!=9))
	{
		echo	'Debe introducir un número de 9 dígitos';
		exit;
	}
	
	$day=date('d');
	$month=date('m');
	$year=date('Y');
	
	$array_age = explode('-',$penista_age);
	$penista_year = $array_age[0];
	$penista_month = $array_age[1];
	$penista_day = $array_age[2];
	
	if($penista_year > $year)
	{
		echo 'Introduzca una fecha de nacimiento verídica1';
		exit;
	}
	
	if(($penista_month > 12) | ($penista_month < 0) )
	{
		echo 'Introduzca una fecha de nacimiento verídica2'.$penista_month;
		exit;
	}
	
	if(($penista_day > 31) | ($penista_day < 0) )
	{
		echo 'Introduzca una fecha de nacimiento verídica3';
		exit;
	}
	
	if(($year - $penista_year) > 120)
	{
		echo 'Introduzca una fecha de nacimiento verídica4';
		exit;
	}
	
	
	if(($year - $penista_year) > 18)
	{
		
	}
	else if(($penista_month - $month) > 0)
	{
		
	}
	else if(($penista_day - $day) >= 0)
	{
		
	}
	else
	{
		echo 'Para ser peñista debe ser mayor de edad';
		exit;
	}
	
	
	
	
	$hostDB = "localhost";
	$loginDB = "root";
	$passDB = "";
	$nameDB = "FarolesTabernaRock";
		
@ $db = mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
if(!$db) {
	/* Dario's parammeters for the MySQL server. Otherwise it will not work for me (Dar�o) */
	$hostDB="127.0.0.1";
	$passDB="root";
	@ $db = mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
	if(!$db) {
		echo "No fue posible conectarse con la base de Datos " .  $db->connect_error();
		exit();
	}
}
	mysqli_set_charset($db,"utf8");
	if	(!$db)
	{
		echo	'Error:	No	se	ha	podido	realizar	la	conexión	con	la	Base	de	Datos.	Por	favor,	inténtelo	
					de	nuevo	más	tarde.';
		exit;
	}

	$query	=	"insert	into penista values	
					(NULL,	'".	$clothes	."',	'".	$clothes_size	."',	'".	$penista_name	."',	'".	$penista_surname	."',	'"	.	$penista_email	."',  '"	.	$penista_telephone	."',  '"	.	$penista_age	."', NULL )";	
	$resultado	=	mysqli_query($db,	$query);
	
	// echo "el resultado es: " .$resultado;


mysqli_close($db);
?>
</body>
</html>