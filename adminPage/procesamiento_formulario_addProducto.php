<?php include("../MySQL/mysqliFunctions.php"); ?>
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
		<title>Introducción	de Producto</title>
</head>
<h3>Resultado	de	la	Introducción	de	producto</h3>

</html>




<?php

	//-------------------------UPLOADING THE IMAGE-------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------
	$target_dir = "../photos/FotosMenu/";
	if(isset($_FILES["fileToUpload"])) {
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	}
	// Check if image file is a actual image or fake image
	/*if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}*/
	//We will have to check if the image has the size we want.
	// Check file size
	if(isset($_FILES["fileToUpload"])) {
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
	}
	// Allow certain file formats
	/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}*/
	// Check if $uploadOk is set to 0 by an error
	if(isset($_FILES["fileToUpload"])) {
		if ($uploadOk == 0) {
			echo "<script type=\"text/javascript\">alert('No se ha podido cargar la foto')</script>";
			exit;
		}
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha cargado con éxito.";
			} else {
				echo "Vaya, parece que ha habido un error al cargar la imagen.";
			}
		}
	}
//----------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------IMAGE UPLOADED-------------------------------------------------------------------------------
//------------------------------------Processing the form values-------------------------------------------------------------------

	@ $product_name = $_POST['ProductName'];
	@ $description = $_POST['Description'];
	@ $calories = $_POST['Calories'];
	@ $price = $_POST['Price'];
	@ $kind = $_POST['Kind'];
	@ $image = basename( $_FILES["fileToUpload"]["name"]);
	
	$product_name = normalizeData($product_name);
	$description = normalizeData($description);
	$calories = normalizeData($calories);
	$price = normalizeData($price);
	$kind = normalizeData($kind);
	
	if	(!$product_name || !$description || !$calories || !$price || !$kind || !$image) {
		echo "<script type=\"text/javascript\">alert('Rellene todos los campos por favor')</script>";
		exit; 
	}

	/*
	$product_name = trim($product_name);
	$description = trim($description);
	$calories = trim($calories);
	$price = trim($price);
	$kind = trim($kind);
		
	$product_name	=	addslashes($product_name);
	$description	=	addslashes($description);
	$calories	=	addslashes($calories);
	$price	=	addslashes($price);
	$kind	=	addslashes($kind);
	$image	=	addslashes($image);
	*/

	$allowedCharacters = "aáäàâbcçdeéëèêfghiíïìîjklmnoóöòôpqrstuúüùûvwxyzAÁÄÀÂBCÇDEÉËÈÊFGHIJKLMNOÓÖÒÔPQRSTUÚÜÙÛVWXYZ-_'\\";
	
	$array_name = explode(' ',$product_name);
	$num = count($array_name);
	
	for ($i = 0 ; $i < $num ; $i++) {
		for ($j = 0 ; $j < strlen($array_name[$i]) ; $j++) {
			if (strpos($allowedCharacters, substr($array_name[$i], $j, 1)) === false) {
				echo "<script type=\"text/javascript\">alert('Introduzca un nombre válido por favor. ".$array_name[$i]." no es válido')</script>";
				exit;
			}
		} 
	}

	if(!is_numeric($calories)) {
		echo "<script type=\"text/javascript\">alert('Introduzca un valor numérico en calorías por favor.')</script>";
		exit();
	}

	if(!is_numeric($price)) {
		echo "<script type=\"text/javascript\">alert('Introduzca un valor numérico en precio por favor.')</script>";
		exit;
	}

	$image_name = explode(".", $image);

	if($image_name[1] != "jpg" && $image_name[1] != "gif" && $image_name[1] != "png") {
		echo "<script type=\"text/javascript\">alert('El formato de imagen introducido no es válido (.jpg .gif o .png)')</script>";
		exit;
	}

	/*
    @ $db = mysqli_connect('localhost',	'root',	'',	'FarolesTabernaRock');
	mysqli_set_charset($db,"utf8");
	if	(!$db) {
		echo "<script type=\"text/javascript\">alert('No se ha podido conectar con la base de datos')</script>";
		exit();
	}
	*/
	$db = connectDB();
	
	$query1 = "SELECT product_name from food";	
	$repetidos = mysqli_query($db,$query1);
	$num=mysqli_num_rows($repetidos);

	for ($i=0 ; $i < $num ; $i++) {
		$fila = mysqli_fetch_array($repetidos);
		if ($fila['product_name'] == $product_name) {
			echo "<script type=\"text/javascript\">alert(\"Vaya, parece que este producto ya está registrado\");</script>";
			exit;
		}
	}
	$query = "INSERT into food values	
					(NULL,	'".	$product_name	."',	'".	$description	."',	'".	$calories	."',	'".	$price	."',	'"	.	$kind	."',  '"	.	$image	."')";	
	$resultado	=	mysqli_query($db,	$query);

	if($db->error) {
        echo "Ha ocurrido un error en la inserción de los datos" . $db->error;
    }
	
    mysqli_close($db);

	echo "<script type=\"text/javascript\">alert(\"Producto registrado correctamente\");</script>";
	echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha cargado con éxito.";
	echo "<a href=\"luna.php\">Redireccionar a la pagina del administrador.</a>";

?>
