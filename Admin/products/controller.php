<?php include("../../MySQL/mysqliFunctions.php"); ?>
<?php
	session_start();
	if(@$_SESSION['privilege'] != 1) {
		echo 'No tiene permiso para acceder a esta p&aacute;gina';
		exit();
	}
?>

<html> <meta charset="UTF-8" /> </html>
<?php
	if(!isset($_GET['action'])) {

	}
	else {
		$db = connectDB();
	
		switch($_GET['action']) {
			//-----------------------------------FUNCTION LIST PRODUCTS-------------------------------------------------------------------------
			case "show":
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
						<td>"."<img class='order_Menu_Product_DeleteButton'"."src='../../photos/Delete.png'"."alt='Delete Button'"."onclick='deleteProduct(${row['id_product']})'"."'/>"."</td>
						<td>"."<img  style='width: 70px; float: left;' src='../../photos/FotosMenu/".$row['image']."'/>"."</td>
						<td>".$row['product_name']."</td>
						<td>".$row['description']."</td> 
						<td>".$row['price']."</td> 
						<td>".$row['calories']."</td> 
						<td>".$row['kind']."</td>
						<td>"."<img style='width: 30px;' class='order_Menu_Product_EditButton'"."src='../../photos/Edit.png'"."alt='Edit Button'"." onclick='editProduct(${row['id_product']})'"."'/>"."</td> 
					</tr>";
				}
				echo "</table>"; //close the table
				break;
			
			//-----------------------------------FUNCTION DELETE PRODUCT------------------------------------------------------------------------
			case "delete":
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
				}
				$query = "DELETE from food WHERE id_product=' ".$id." '";
				$result = mysqli_query($db,$query);
				
				if($db->error) {
					echo "Ha ocurrido un error en la inserción de los datos" . $db->error;
				}
				break;
			
			//-----------------------------------FUNCTION EDIT PRODUCT------------------------------------------------------------------------
			case "edit":
				if(isset($_GET['id'])) {
					$id = $_GET['id'];
				}

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

				break;
		}
		mysqli_close($db);
	}
?>