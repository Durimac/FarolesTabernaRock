<?php
session_start();
if(@$_SESSION['privilege']!=1)
{
	echo 'No tiene permiso para acceder a esta p&aacute;gina';
	exit();
}
?>
<html>
<meta charset="UTF-8" />
<body>
	<header>
		<div class="header">
			<a class="logo" href="../indexPage/index.php">
				<img class="logo" src="../photos/logofaroles.png" alt="Logo Faroles Taberna Rock"/>
			</a>

			<!-- Row Menu -->
			<nav class="headerMenu">
				<a class="menu" href="../menuPage/menu.php"> Menú</a>
				<a class="menu" href="../eventsPage/events.php"> Eventos</a>
				<a class="menu" href="../aboutUsPage/aboutUs.php"> ¿Quiénes somos?</a>
				<a class="menu" href="../contactPage/contact.php"> Contacto</a>
				<a class="foodThinking" href="../orderPage/orders.php">
					<img class="foodThinking" src="../photos/FoodThinking.png" alt="Thinking in food" />
				</a>
			</nav>
		</div>
	</header>
	
	<div class="button">
		<button class="button" type="button"  onclick="ListarProductos();">Listar Productos</button>
		<!--<button class="button" type="button"  onclick="cerrarSesion(); location.href='../indexPage/index.php';">Cerrar Sesión</button> -->	
		<button class="button" type="button"  onclick="cerrarSesion();">Cerrar Sesión</button>
	</div>
	<p id="ListaDeProductos"></p>
</body>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function ListarProductos()
{
	$.ajax({

	method:	"POST",
	url: "adminfunctions.php",
	data:{action:"show_products"},
	success:
	function(hola)		{document.getElementById("ListaDeProductos").innerHTML = hola}	
	});
}

function addProduct(productID)
{
	alert("El id del producto es:" + productID);
}

function cerrarSesion()
{
	alert("En cerrarSesion()");
	$.ajax({

	method:	"POST",
	url: "adminfunctions.php",
	//data:{action:"close"},
	//success:
	//function()		{alert("Se ha cerrado la sesión");}	
	});	
}

</script>
</html>
