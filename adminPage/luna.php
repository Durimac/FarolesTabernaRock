<?php
session_start();
if(@$_SESSION['privilege']!=1)
{
	echo 'No tiene permiso para acceder a esta p&aacute;gina';
	exit();
}
include('../header.php');
?>
<html>
<body>	
	<div class="button">
		<button class="button" type="button"  onclick="ListarProductos();">Listar Productos</button>
		<button class="button" type="button"  onclick="cerrarSesion();">Cerrar Sesión</button>
		<button class="button" type="button"  onclick="location.href='formulario_aniadir_producto.php';">Añadir Producto</button>
	</div>
	<p id="ListaDeProductos"></p>
</body>	
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script>

function ListarProductos()
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ListaDeProductos").innerHTML=xmlhttp.responseText;}
	};
	xmlhttp.open("GET","adminfunctions.php?q=show",true);
	xmlhttp.send();
}

function deleteProduct(productID)
{
	if (checkeacomosemeneaea())
	{
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
function checkeacomosemeneaea()
{
	return confirm("¡ATENCION! ¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer");
}

function cerrarSesion()
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			alert("Se ha cerrado la sesión con éxito");
			location.replace("../indexPage/index.php")}
	};
	xmlhttp.open("GET","adminfunctions.php?q=close",true);
	xmlhttp.send();
}


 // function selecter(tipo)
	// {
		// alert("estamos en la funcion!!");
		// console.log(tipo);
            // switch (tipo)
			// {
				// case "Carta":
                // document.getElementById("carta").selected = true;
                // break;
					
				// case "Especialidades":
				// alert("estamos aqui!!");
                // document.getElementById("especialidad").selected = true;
                // break;

				// case "Hamburguesas":
                // document.getElementById("hamburguesas").selected = true;
                // break;
					
				// case "CartaVegana":
                // document.getElementById("cartavegana").selected = true;
                // break;
					
				// case "HamburguesaVegana":
                // document.getElementById("hamburguesavegana").selected = true;
                // break;					
            // }
    // }
	
			// function disabler(availability) {
			        // if (availability) {
			            // document.getElementById('fileToUpload').disabled = true;
						// document.getElementById('actualImage').disabled = false;
						// document.getElementById('instructions').innerHTML = ('Seleccione la nueva imagen');
						// document.getElementById('instructions').value = 'fileToUpload';			}
			       // else {
							// document.getElementById('fileToUpload').disabled = false;
							// document.getElementById('instructions').innerHTML = ('');	}	}	



function editProduct(productID)
{
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

           
</script>
</html>
