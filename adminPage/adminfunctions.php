<?php include("../MySQL/mysqliFunctions.php"); ?>
<?php
	session_start();
	if(@$_SESSION['privilege'] != 1) {
		echo 'No tiene permiso para acceder a esta p&aacute;gina';
		exit();
	}
?>

<html> <meta charset="UTF-8" /> </html>
<?php
/*
	$hostDB="localhost";
	$loginDB="root";
	$passDB="";
	$nameDB="FarolesTabernaRock";
*/
//-----------------------------------FUNCTION LIST PRODUCTS-------------------------------------------------------------------------
	if(isset($_GET['q']) && $_GET['q'] == "show") {
		/*
		@$db = mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		*/
		$db = connectDB();

		$query = "SELECT * from food";
		$result = mysqli_query($db,$query);
		
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">"; // open the table 

		echo " 
		<tr> 
			<td>Borrar</td>
			<td>Foto</td>
			<td>Nombre Producto</td> 
			<td>Descripción</td> 
			<td>Precio</td> 
			<td>Calorias</td> 
			<td>Tipo</td>
			<td>Editar</td> 
		</tr>";

		while($row = mysqli_fetch_array($result)) {		
			echo "
			<tr>
				<td>"."<img class='order_Menu_Product_DeleteButton'"."src='../photos/Delete.png'"."alt='Delete Button'"."onclick='deleteProduct(${row['id_product']})'"."'/>"."</td>
				<td>"."<img  style='width: 70px; float: left;' src='../photos/FotosMenu/".$row['image']."'/>"."</td>
				<td>".$row['product_name']."</td>
				<td>".$row['description']."</td> 
				<td>".$row['price']."</td> 
				<td>".$row['calories']."</td> 
				<td>".$row['kind']."</td>
				<td>"."<img style='width: 30px;' class='order_Menu_Product_EditButton'"."src='../photos/Edit.png'"."alt='Edit Button'"." onclick='editProduct(${row['id_product']})'"."'/>"."</td> 
			</tr>";
		}
		echo "</table>"; //close the table

		mysqli_close($db);
	}
//-----------------------------------FUNCTION CLOSE SESSION------------------------------------------------------------------------
	else if(isset($_GET['q']) && $_GET['q'] == "close") { 
		//echo "session destroyed";
		session_destroy();
	}
//-----------------------------------FUNCTION DELETE PRODUCT------------------------------------------------------------------------
	else if(isset($_GET['q']) && $_GET['q'] == "delete") {
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		/*
		@$db = mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		*/
		$db = connectDB();

		$query = "DELETE from food WHERE id_product=' ".$id." '";
		$result = mysqli_query($db,$query);

		mysqli_close($db);
	} 
//-----------------------------------FUNCTION EDIT PRODUCT------------------------------------------------------------------------
	//Get the product values from the database
	else if(isset($_GET['q']) && $_GET['q'] == "edit") {
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		/*
		@$db = mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		*/
		$db = connectDB();

		$query = "SELECT * from food WHERE id_product=' ".$id." '";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_array($result)) {
			$_SESSION["product_name"] = $row['product_name'];
			$_SESSION["description"] = $row['description'];
			$_SESSION["calories"] = $row['calories'];
			$_SESSION["price"] = $row['price'];
			$_SESSION["kind"] = $row['kind'];
			$_SESSION["image"] = $row['image'];
			$_SESSION["id_product"] = $row['id_product'];		
		}
			
		mysqli_close($db);
		
		//echo "<script type=\"text/javascript\">";
		//echo "location.href=' ./formulario_editar_producto.php'</script>";
		//header("Location: ./formulario_editar_producto.php");
		//exit;
	}
//-----------------------------------FUNCTION LIST PENISTAS------------------------------------------------------------------------
	if(isset($_GET['q']) && $_GET['q'] == "showPenistas") {
		/*
		@$db = mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		*/
		$db = connectDB();

		$query = "SELECT * from penista";
		$result = mysqli_query($db,$query);
		
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">"; // open the table 

		echo " 
		<tr>
			<td>Borrar</td> 
			<td>Nombre</td>
			<td>Apellidos</td>
			<td>Teléfono</td> 
			<td>Email</td> 
			<td>Fecha de Nacimiento</td> 
			<td>Ropa</td> 
			<td>Talla</td>
			<td>Editar</td> 
		</tr>"; 
		while($row = mysqli_fetch_array($result)) {
			echo "
			<tr>
				<td>"."<img class='order_Menu_Product_DeleteButton'"."src='../photos/Delete.png'"."alt='Delete Button'"."onclick='deletePenista(${row['id_penista']})'"."'/>"."</td>
				<td>".$row['penista_name']."</td>
				<td>".$row['penista_surname']."</td> 
				<td>".$row['penista_phone']."</td>
				<td>".$row['penista_age']."</td>  
				<td>".$row['penista_email']."</td> 
				<td>".$row['clothes']."</td>
				<td>".$row['clothes_size']."</td>
				<td>"."<img style='width: 30px;' class='order_Menu_Product_EditButton'"."src='../photos/Edit.png'"."alt='Edit Button'"." onclick='editPenista(${row['id_penista']})'"."'/>"."</td> 
			</tr>";
		}
		echo "</table>"; //close the table 

		mysqli_close($db);
	}
//-----------------------------------FUNCTION DELETE PENISTA------------------------------------------------------------------------

	else if(isset($_GET['q']) && $_GET['q'] == "deletePenista") {
		if(isset($_GET['idPenista'])) {
			$idPenista = $_GET['idPenista'];
		}
		/*
		@$db = mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		*/
		$db = connectDB();

		$query = "DELETE from penista WHERE id_penista=' ".$idPenista." '";
		$result = mysqli_query($db,$query);

		mysqli_close($db);
	}

//-----------------------------------FUNCTION EDIT PENISTA------------------------------------------------------------------------	
	else if(isset($_GET['q']) && $_GET['q'] == "editPenista") {
		if(isset($_GET['idPen'])) {
			$idPen = $_GET['idPen'];
		}
		/*
		@$db = mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		*/
		$db = connectDB();

		$query = "SELECT * from penista WHERE id_penista=' ".$idPen." '";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_array($result)) {
			$_SESSION["penista_name"] = $row['penista_name'];
			$_SESSION["penista_surname"] = $row['penista_surname'];
			$_SESSION["phone"] = $row['penista_phone'];
			$_SESSION["age"] = $row['penista_age'];
			$_SESSION["email"] = $row['penista_email'];
			$_SESSION["clothes"] = $row['clothes'];
			$_SESSION["clothes_size"] = $row['clothes_size'];
			$_SESSION["id_penista"] = $row['id_penista'];		
		}	
					
		mysqli_close($db);
	}
?>
