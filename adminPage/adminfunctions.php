<?php
session_start();
if(@$_SESSION['privilege']!=1)
{
	echo 'No tiene permiso para acceder a esta p&aacute;gina';
	exit();
}
?>

<html> <meta charset="UTF-8" /> </html>
<?php
$hostDB="localhost";
$loginDB="root";
$passDB="";
$nameDB="FarolesTabernaRock";
//$q=$_GET["q"];
//if($_GET["q"] == 'show')
if(isset($_GET['q']) && $_GET['q']=="show")
	//function ListProducts()
	{
		@$db=mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		mysqli_set_charset($db,"utf8");
		$query="select * from food";
		$result=mysqli_query($db,$query);
		//echo"Producto\t\tDescripcion\t\tPrecio\t\tCalorias&nbsp;&nbsp;&nbsp;Tipo"."<BR>";
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">"; // abre la tabla 

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
		$i=0;
		while($row=mysqli_fetch_array($result))
		{			
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
		echo "</table>"; //Cierra la tabla 
		mysqli_close($db);
	}
//elseif($_GET["q"] == 'close')
elseif(isset($_GET['q']) && $_GET['q']=="close")
	{ 
		//echo "session destroyed";
		session_destroy();
	}

elseif(isset($_GET['q']) && $_GET['q']=="delete")
	{
		if(isset($_GET['id'])) {
		$id=$_GET['id'];}
		@$db=mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		$query="DELETE from food WHERE id_product=' ".$id." '";
		$result=mysqli_query($db,$query);
		mysqli_close($db);
	} 
//---------------------------------EDIT FUNCTION-------------------------------------------------------
	//Get the product values from the database
elseif(isset($_GET['q']) && $_GET['q']=="edit")
{
    if(isset($_GET['id'])) {
	$id=$_GET['id'];}
    @$db=mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
    mysqli_set_charset($db,"utf8");
    $query="SELECT * from food WHERE id_product=' ".$id." '";
	$result=mysqli_query($db,$query);
	while($row=mysqli_fetch_array($result))
		{		$_SESSION["product_name"] = $row['product_name'];
	//echo "esto es la variable de sesion". $_SESSION["product_name"];
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


?>
