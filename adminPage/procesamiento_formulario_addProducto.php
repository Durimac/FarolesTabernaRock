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
		<title>Introducción	de Producto</title>
</head>
<body>
<h3>Resultado	de	la	Introducción	de	producto</h3>
<?php

//-------------------------UPLOADING THE IMAGE-------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
$target_dir = "../photos/FotosMenu/";
if(isset($_FILES["fileToUpload"]))
{ 
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
        echo "Vaya, parece que ha habido un error al cargar la imagen.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha cargado con éxito.";
        } else {
            echo "Vaya, parece que ha habido un error al cargar la imagen.";
        }
    }
}
//----------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------IMAGE UPLOADED-------------------------------------------------------------------------------
//------------------------------------Processing the form values-------------------------------------------------------------------


@	$product_name=$_POST['ProductName'];
@	$description=$_POST['Description'];
@	$calories=$_POST['Calories'];
@	$price=$_POST['Price'];
@	$kind=$_POST['Kind'];
@	$image=basename( $_FILES["fileToUpload"]["name"]);
	
	/*$penista_name	=	trim($penista_name);
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
    $clothes_size	=	addslashes($clothes_size);*/

    @	$db	=	mysqli_connect('localhost',	'root',	'',	'FarolesTabernaRock');
	mysqli_set_charset($db,"utf8");
	if	(!$db)
	{
		echo	'Error:	No	se	ha	podido	realizar	la	conexión	con	la	Base	de	Datos.	Por	favor,	inténtelo	
					de	nuevo	más	tarde.';
		exit;
	}
	
	$query1		=	"select product_name from food";	
	$repetidos = mysqli_query($db,$query1);
	$num=mysqli_num_rows($repetidos);
	for ($i=0; $i<$num; $i++)
	{
		$fila = mysqli_fetch_array($repetidos);
		if ($fila['product_name'] == $product_name)
		{
			echo "<script type=\"text/javascript\">alert(\"Vaya, parece que este producto ya está registrado\");</script>";
			exit;
		}
	}
	$query	=	"insert	into food values	
					(NULL,	'".	$product_name	."',	'".	$description	."',	'".	$calories	."',	'".	$price	."',	'"	.	$kind	."',  '"	.	$image	."')";	
	$resultado	=	mysqli_query($db,	$query);
	
    // echo "el resultado es: " .$resultado;
    mysqli_close($db);

    echo "<a href=\"luna.php\">Redireccionar a la pagina del administrador.</a>";
?>
