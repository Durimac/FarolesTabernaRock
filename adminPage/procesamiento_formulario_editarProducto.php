<?php
session_start();
if(@$_SESSION['privilege']!=1)
{
	echo 'No tiene permiso para acceder a esta p&aacute;gina';
	exit();
}
?>
<html>
<head>

	<meta charset="UTF-8" />
		<title>Actualización	de Producto</title>
</head>
<body>
<h3>Resultado	de	la	Actualización	de	producto</h3>
<?php

//-------------------------UPLOADING THE IMAGE-------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
$target_dir = "../photos/FotosMenu/";

if(isset($_FILES["fileToUpload"]))
{ 
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
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
	if(isset($_FILES["fileToUpload"]))
	{ 
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
	if(isset($_FILES["fileToUpload"]))
	{
		if ($uploadOk == 0) {
			echo "Vaya, parece que ha habido un error al cargar la imagen uploadok.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha cargado con éxito.";
			} else {
				echo "Vaya, parece que ha habido un error al cargar la imagen else.";
			}
		}
	}
@	$image=basename( $_FILES["fileToUpload"]["name"]);
}

else{
	@	$image=$_POST['actualImage'];
}
//----------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------IMAGE UPLOADED-------------------------------------------------------------------------------
//------------------------------------Processing the form values-------------------------------------------------------------------


@	$product_name=$_POST['ProductName'];
@	$description=$_POST['Description'];
@	$calories=$_POST['Calories'];
@	$price=$_POST['Price'];
@	$kind=$_POST['Kind'];


	

    @	$db	=	mysqli_connect('localhost',	'root',	'',	'FarolesTabernaRock');
	mysqli_set_charset($db,"utf8");
	if	(!$db)
	{
		echo	'Error:	No	se	ha	podido	realizar	la	conexión	con	la	Base	de	Datos.	Por	favor,	inténtelo	
					de	nuevo	más	tarde.';
		exit;
	}
	

	$query	=	"UPDATE	 food SET	
				product_name='".	$product_name	."',	description='".	$description	."',calories=	'".	$calories	."', price=	".	$price	.", kind=	'"	.	$kind	."', image=  '"	.	$image	."'
				WHERE	id_product=".$_SESSION['id_product'] ; 
	$resultado	=	mysqli_query($db,	$query);
	echo $query ;
	//$num=mysqli_num_rows($resultado);
	//echo "el ide del producto es: " .$_SESSION['id_product'];
    //echo "filas afectadas: " .$num;
    mysqli_close($db);

    echo "<a href=\"luna.php\">Redireccionar a la pagina del administrador.</a>";
?>
