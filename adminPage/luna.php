<?php
session_start();
if(@$_SESSION['privilege'] != 1) {
	echo 'No tiene permiso para acceder a esta p&aacute;gina';
	exit();
}
?>
<?php include('../header.php'); ?>
<!-------------------------------------------------ADMIN BUTTONS---------------------------------------------------------------->
<body>	
	<div class="button">
		<button class="button" type="button"  onclick="ListarProductos();">Listar Productos</button>		
		<button class="button" type="button"  onclick="location.href='formulario_aniadir_producto.php';">Añadir Producto</button>
		<button class="button" type="button"  onclick="ListPenistas();">Listar Peñistas</button>
		<button class="button" type="button"  onclick="location.href='../contactPage/form.html';">Añadir Peñista</button>
		<button class="button" type="button"  onclick="cerrarSesion();">Cerrar Sesión</button>
	</div>
	<p id="ListaDeProductos"></p>
</body>	

<script>

function ListarProductos() {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ListaDeProductos").innerHTML=xmlhttp.responseText;}
	};
	xmlhttp.open("GET","adminfunctions.php?q=show",true);
	xmlhttp.send();
}



function deleteProduct(productID) {
	if (checkeacomosemeneaea()) {
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
					alert("producto eliminado correctamente");
					ListarProductos();}
			};
		xmlhttp.open("GET","adminfunctions.php?q=delete&id=" + productID,true);
		xmlhttp.send();
	}
	//We will have to add the functionality to delete the image stored at the server associated to the product
}



function checkeacomosemeneaea() {
	return confirm("¡ATENCION! ¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer");
}



function cerrarSesion() {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			alert("Se ha cerrado la sesión con éxito");
			location.replace("../indexPage/index.php")}
	};
	xmlhttp.open("GET","adminfunctions.php?q=close",true);
	xmlhttp.send();
}
	


function editProduct(productID) {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function ()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			//document.getElementById("ListaDeProductos").innerHTML=xmlhttp.responseText;
			//selecter();
			location.replace("./formulario_editar_producto.php")
			//alert("producto editado correctamente");
		}
	};
	xmlhttp.open("GET","adminfunctions.php?q=edit&id=" + productID,true);
	xmlhttp.send();
}
//---------------------------------------------PENISTA FUNCTIONS--------------------------------------------------------------
function ListPenistas() {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ListaDeProductos").innerHTML=xmlhttp.responseText;}
	};
	xmlhttp.open("GET","adminfunctions.php?q=showPenistas",true);
	xmlhttp.send();
}

function deletePenista(penistaID) {
	if (checkeacomosemeneaea()) {
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
					alert("Peñista eliminado correctamente");
					ListPenistas();}
			};
		xmlhttp.open("GET","adminfunctions.php?q=deletePenista&idPenista=" + penistaID,true);
		xmlhttp.send();
	}
}



function checkiraut() {
	return confirm("¡ATENCION! ¿Estás seguro de que deseas eliminar este peñista? Esta acción no se puede deshacer");
}


function editPenista(penID) {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			location.replace("./editPenistaForm.php")
		}
	};
	xmlhttp.open("GET","adminfunctions.php?q=editPenista&idPen=" + penID,true);
	xmlhttp.send();
}
           
</script>
</html>
