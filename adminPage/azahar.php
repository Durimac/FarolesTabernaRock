<?php include("../MySQL/mysqliFunctions.php"); ?>
<?php
	session_start();
?>
<html>
	<meta charset="UTF-8" />
</html>
<?php
	@ $login = $_POST['Admin_Name'];
	@ $password = $_POST['Admin_Pass'];

	$login = normalizeData($login);
	$password = normalizeData($password);

	if(!$login || !$password) {
		echo "Hay campos vacíos.";
		exit();
	}

	$db = connectDB();

	//Consulta para comprobar campos repetidos
	$query = "SELECT * FROM administrator WHERE admin_username='".$login."' AND admin_password='".$password."'";
	$result = mysqli_query($db,$query);
	$numerOfRows = mysqli_num_rows($result);
	if($numerOfRows != 1) {
		echo "El nombre o la contraseña no coinciden, comprueba los datos.<br>";
		echo "<a href=\"libertad.php\">Volver a la pagina anterior.</a>";
	}
	else {
		$row = mysqli_fetch_array($result);
		$_SESSION['login'] = $login;
		$_SESSION['privilege'] = $row['admin_power'];
		echo "Ha iniciado sesión con éxito.";
		echo "<a href=\"luna.php\">Redireccionar a la pagina del administrador.</a>";
	}
?>