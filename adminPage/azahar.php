<?php
session_start();
?>
<html>
<meta charset="UTF-8" />
</html>
<?php
@ $login = $_POST['Admin_Name'];
@ $password = $_POST['Admin_Pass'];

$login = trim($login);
$password = trim($password);


if(!$login || !$password)
{
	echo "Hay campos vacíos.";
	exit();
}


// Preprocesamiento
$login = addslashes($login);
$password = addslashes($password);

@	$db	=	mysqli_connect('localhost',	'root',	'',	'FarolesTabernaRock');

	if	(!$db)
	{
		echo	'Error:	No	se	ha	podido	realizar	la	conexión	con	la	Base	de	Datos.	Por	favor,	inténtelo	
					de	nuevo	más	tarde.';
		exit;
	}
	

//Consulta para comprobar campos repetidos

$query="SELECT * FROM administrator WHERE admin_username='".$login."' AND admin_password = '".$password."'";
$resultado=mysqli_query($db,$query);
$num=mysqli_num_rows($resultado);
if($num!=1)
{
	echo "El nombre o la contraseña no coinciden, comprueba los datos.<br>";
	echo "<a href=\"libertad.php\">Volver a la pagina anterior.</a>";
}
else
{
	$fila=mysqli_fetch_array($resultado);
	$_SESSION['login']=$login;
	$_SESSION['privilege']=$fila['admin_power'];
	echo "Ha iniciado sesión con éxito.";
	echo "<a href=\"luna.php\">Redireccionar a la pagina del administrador.</a>";
}
?>