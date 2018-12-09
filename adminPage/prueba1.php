<?php include('../cabecera.php'); ?>

	<h1 class="title_Name">Realiza tu peidido</h1>
	<hr align="left" class="title_Underline">

	<div class="order_Container">
		<div class="order_Menu">
			<ul class="order_Menu_Type" id="order_Menu_Type"></ul>
		</div>
		<div class="order_CurrentOrder">
			<h4 class="order_CurrentOrder_Title">Pedido actual</h4>
			<hr class="order_CurrentOrder_Title">
			<ul class="order_CurrentOrder_List" id="order_CurrentOrder_List"></ul>
			<h4 class="order_CurrentOrder_Total" id="order_CurrentOrder_Total"></h4>
		</div>
	</div>

	<!-- ADDING MODAL -->
	<div class="modal_Adding_Bacground" id="modal_Adding">
		<!-- Modal content -->
		<div class="modal_Adding_Container">
			<h3 class="modal_Adding_Container_Title" id="modal_Adding_Container_Title"></h3>

			<div class="modal_Adding_Container_AmountAndPrice">
				<div class="modal_Adding_Container_Amount">
					Cantidad
					<select name="select_Amount" id="select_Amount" onchange="setPrice()">
						<option selected>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
					</select>
				</div>

				<div class="modal_Adding_Container_Price">
					Precio
					<p class="modal_Adding_Container_Price" id="modal_Adding_Container_Price"></p>
				</div>
			</div>

			<div class="modal_Adding_Container_Buttons">
				<button class="modal_Adding_Container_Button" onclick="closeModal_Adding()">Cancelar</button>
				<button class="modal_Adding_Container_Button" onclick="addProductToOrder()">Añadir</button>
			</div>
		</div>
	</div>
</body>


<?php
//$hostDB="vulcano.tel.uva.es";
$hostDB="localhost";
//$loginDB="taw010";
//$passDB="3eo0u4b9";
$loginDB="root";
$passDB="";
$nameDB="FarolesTabernaRock";

// @ $db=mysql_pconnect($hostDB, $loginDB, $passDB);
@ $db=mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
if(!$db)
{
	echo "No fue posible conectarse con la base de Datos";
	exit();
}


// mysql_select_db($nameDB);
$query="SELECT * FROM food";
// $resultado=mysql_query($query);
$resultado=mysqli_query($db, $query);
// $num=mysql_num_rows($resultado);
$num=mysqli_num_rows($resultado);
echo "El numero de productos encontrado es: " . $num ."<BR>";
for($i=0;$i<$num;$i++)
{
	// $fila=mysql_fetch_array($resultado);
	$fila=mysqli_fetch_array($resultado);

	        //echo  "<img  style='width: 400px; float: left;'  CLASS='imgBalonF1' src='BalonesFotos/Balones/" . $fila['tipo'] . "/".$fila['foto']."'/>";
			echo  "<img  style='width: 70px; float: left;' src='../photos/FotosMenu/".$fila['image']."'/>";
            echo  "<span >Nombre producto: ".$fila['product_name']."</span><BR>";
			echo  "<span >Descripción: ".$fila['description']."</span><BR>";
            echo  "<span >Precio: ".$fila['price']."&#8364</span><BR>";
			
			echo "<form method='post'>";	//echo "<form method='post' action='comprar_producto.php'>";
            echo "<input type='hidden' name='id_producto' value='".$fila['id_product']."'>";
            echo "<select type='text' title='Cantidad del producto' name='cantidad'><option selected>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select>";
            echo "<input type='submit' value='Comprar'>";
            echo "</form>";
            
   
}
mysqli_close($db);
?>

<!-- Script for fill the Menu list -->
<!--
<script>
	const veganFood = [
		{ name: "TORITILLA CASERA BUENA QUE TE CAGAS", price: "5.30", description: "Cosa verde poco sabrosa" },
		{ name: "Flores", price: "6.50", description: "Al menos huele bien..." },
		{ name: "Tofu", price: "1.30", description: "Nunca he sabíoh lo que es Hulio" },
	];
	const carnianFood = [
		{ name: "Vaca", price: "9.20", description: "Carne de animal con 4 patas y cuernos" },
		{ name: "Ciervo", price: "20.95", description: "Carne de animal con 4 patas y cuernos más largos" },
	];

	const foodTypesList = [
		{ type: "Vegano", productsList: veganFood },
		{ type: "Carnívoro", productsList: carnianFood }
	];

	var typesList = "";
	for (const type of foodTypesList) {
		const newTypeItem = `
			<li class="order_Menu_Type">
				<h4 class="order_Menu_Type">${type.type}</h4>
				<ul class="order_Menu_ProductsList">${fillOneType(type.productsList)}</ul>
			</li>
		`
		typesList += newTypeItem;
		document.getElementById("order_Menu_Type").innerHTML = typesList;
	}

	function fillOneType(productsList) {
		var listItems = "";
		for (const product of productsList) {
			var newListItem = `
				<li class="order_Menu_Product">
					<div class="order_Menu_Product_Details">
						<div class="order_Menu_Product_Details_NameAndPrice">
							<div class="order_Menu_Product_Details_Name">${product.name}</div>
							<div class="order_Menu_Product_Details_Price">${product.price} E</div>
						</div>
						<div class="order_Menu_Product_Details_Description">${product.description}</div>
					</div>

					<div class="order_Menu_Product_AddButton">
						<img class="order_Menu_Product_AddButton" 
							src="../photos/Add.png" 
							alt="Add Button" 
							onclick="openModal_Adding('${product.name}', '${product.price}')"
						/>
					</div>
				</li>
				<hr align="left" class="order_Menu_Product_Separator">
			`;
			listItems += newListItem;
		}
		return listItems;
	}
</script>
-->
<!-- Script for fill the Current Order list -->
<!--
<script>
	var totalPrice = 0.00;
	var currentOrderList = "";
	function addProductToOrder() {
		const select_Amount = document.getElementById("select_Amount");
		const amount = select_Amount.options[select_Amount.selectedIndex].text;

		var newProduct = `
			<li class="order_CurrentOrder_Product">
				<img class="order_CurrentOrder_Product_DeleteButton" 
					src="../photos/Delete.png" 
					alt="Delete Button" 
					onclick="deleteProductFromOrder()"
				/>
				<div class="order_CurrentOrder_Product_NameAndPrice">
				<div class="order_CurrentOrder_Product_Name">
					${document.getElementById("modal_Adding_Container_Title").innerHTML} x${amount}
				</div>

				<div class="order_CurrentOrder_Product_Price">
					${document.getElementById("modal_Adding_Container_Price").innerHTML} 
				</div>
			</div>
			</li>
		`;

		currentOrderList += newProduct;
		document.getElementById("order_CurrentOrder_List").innerHTML = currentOrderList;
			
		getTotal(document.getElementById("modal_Adding_Container_Price").innerHTML)

		closeModal_Adding();
	}

	function getTotal(newAmount) {
		totalPrice = parseFloat(totalPrice) + parseFloat(newAmount);

		document.getElementById("order_CurrentOrder_Total").innerHTML = `TOTAL:  ${parseFloat(totalPrice).toFixed(2)} E`;
	}

	function deleteProductFromOrder() {
		
	}
</script>
-->
<!-- Script for showing the Adding Modal, includint Title and Price-->
<!--
<script>
	var product_Price = "";
	var product_Name = "";

	function openModal_Adding(productName, productPrice) {
		document.getElementById("modal_Adding_Container_Title").innerHTML = `${productName}`;

		product_Name = productName;
		product_Price = productPrice;

		setPrice()
		// When the user clicks on the button, open the modal
		document.getElementById("modal_Adding").style.display = "block";
	}

	function closeModal_Adding() {
		// When the user clicks on the button, close the modal
		document.getElementById("modal_Adding").style.display = "none";
	}

	function setPrice() {
		const select_Amount = document.getElementById("select_Amount");
		const amount = select_Amount.options[select_Amount.selectedIndex].text;
		const price = parseFloat(product_Price * amount).toFixed(2);
		document.getElementById("modal_Adding_Container_Price").innerHTML = `${price} E`;
	}
</script>
-->
</html>