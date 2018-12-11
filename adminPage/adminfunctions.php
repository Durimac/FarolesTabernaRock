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
				<td>"."<img style='width: 30px;' class='order_Menu_Product_EditButton'"."src='../photos/Edit.png'"."alt='Edit Button'"."onclick='editProduct(${row['id_product']})'"."'/>"."</td> 
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
		{	
			echo "
			<form action='procesamiento_formulario_editarProducto.php' target='_blank' accept-charset='UTF-8'  method='post' enctype='multipart/form-data' >";
			//echo "<body onmouseover='selecter(".'"'.$row['kind'].'"'.")'>";
			echo "Tipo: <select value=".$row['kind']." type='text' title='Tipo del producto' name='tipo'><option selected>".$row['kind']."</option><option>Futbol</option><option>Baloncesto</option><option>Otros</option></select><BR>";
			echo "	<fieldset>
					<legend>Editar Producto:</legend>
					Nombre del producto:<br>
					<input type='text' name='ProductName' value=".$row['product_name']." maxlength='20' required autofocus>
					<br>
					Descripción:<br>
					<textarea name='Description' rows='5' cols='100' required>".$row['description']."</textarea>
					<br>
					Calorias:<br>
					<input type='text' name='Calories' value=".$row['calories']." maxlength='20' required>
					<br>
					Precio:<br>
					<input type='text' name='Price' value=".$row['price']." required maxlength='20'>
					<br>
					Tipo:<br>
					<select  type='text' title='Tipo del producto' name='tipo'>
					<option value=".$row['kind']."selected>".$row['kind']."</option>
					<option id='carta'	value='Carta'>Carta</option>
					<option id='especialidad'	value='Especialidades'>Especialidades</option>
					<option id='hamburguesas'	value='Hamburguesas'>Hamburguesas</option>
					<option id='cartavegana'	value='CartaVegana'>CartaVegana</option>
					<option id='hamburguesavegana'	value='HamburguesaVegana'>HamburguesaVegana</option>
					</select><br>					
					<!-- In the future, this function must get the kinds from the database and be able to create a new kind-->
					<br><br><br>       
					<br><br>
					<input type='submit' value='Aceptar'>
				</fieldset>
				</body>
			</form>";
			//echo "<script type=\"text/javascript\">selecter('CartaVegana');</script>";
			//echo selecter('CartaVegana');;
		}
		
		
    mysqli_close($db);
}
// <select name='Kind' size='1' onclick='selecter(".'"'.$row['kind'].'"'.")'>
/*<select name='Kind' size='1 >							
						<option id='carta'	value='Carta'>Carta</option>
						<option id='especialidad'	value='Especialidades'>Especialidades</option>
						<option id='hamburguesas'	value='Hamburguesas'>Hamburguesas</option>
						<option id='cartavegana'	value='CartaVegana'>CartaVegana</option>
						<option id='hamburguesavegana'	value='HamburguesaVegana'>HamburguesaVegana</option>
					</select>*/
?>
