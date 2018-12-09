<?php
$hostDB="localhost";
$loginDB="root";
$passDB="";
$nameDB="FarolesTabernaRock";
echo "mierda";
if($_POST['action'] == 'show_products')
	//function ListProducts()
	{
		@$db=mysqli_connect($hostDB,$loginDB,$passDB,$nameDB);
		$query="select * from food";
		$result=mysqli_query($db,$query);
		//echo"Producto\t\tDescripcion\t\tPrecio\t\tCalorias&nbsp;&nbsp;&nbsp;Tipo"."<BR>";
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">"; // abre la tabla 

		echo " 
		<tr> 
			<td>Foto</td>
			<td>Nombre Producto</td> 
			<td>Descripción</td> 
			<td>Precio</td> 
			<td>Calorias</td> 
			<td>Tipo</td> 
		</tr>"; 
		$i=0;
		while($row=mysqli_fetch_array($result))
		{			
			echo "
			<tr>
				<td>"."<img class='order_Menu_Product_AddButton'"."src='../photos/Add.png'"."alt='Add Button'"."onclick='addProduct(${row['id_product']})'"."'/>"."</td>
				<td>"."<img  style='width: 70px; float: left;' src='../photos/FotosMenu/".$row['image']."'/>"."</td>
				<td>".$row['product_name']."</td>
				<td>".$row['description']."</td> 
				<td>".$row['price']."</td> 
				<td>".$row['calories']."</td> 
				<td>".$row['kind']."</td> 
			</tr>";
		}
		echo "</table>"; //Cierra la tabla 
		mysqli_close($db);
	}
elseif($_POST['action'] == 'close')
	{ 
		echo "session destroyed";
		session_destroy();
	}
?>