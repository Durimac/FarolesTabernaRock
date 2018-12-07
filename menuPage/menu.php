<?php include('../header.php'); ?>

	<!-- Main title and "underline" -->
	<h1 class="title_Name"> Menú </h1>
	<hr align="left" class="title_Underline">

	<section>
		<table class="food">
			<tr>
				<th class="foodMenu">Toritlla de patatas con cebolla </th>
				<th class="foodMenu">Toritlla de patatas sin cebolla </th>
			</tr>

			<tr>
				<th> <img class="menuPhoto" src="../photos/tortilla.jpg" alt="Tortilla casera con cebolla"/> </th>
				<th> <img class="menuPhoto" src="../photos/tortillasin.jpg" alt="Tortilla casera sin cebolla"/> </th>
			</tr>
			<tr>
				<th class="foodMenu">Croquetas</a> </th>
				<th class="foodMenu">Hamburguesa gourmet</a> </th>
			</tr>

			<tr>
				<th> <img class="menuPhoto" src="../photos/croquetas.jpg" alt="Croquetas caseras"/> </th>
				<th> <img class="menuPhoto" src="../photos/hamburguesaGourmet.jpg" alt="Hamburguesa de buey"/> </th>
			</tr>

			<tr>
				<th class="foodMenu">Plato vegano</a> </th>
				<th class="foodMenu">Callos</a> </th>
			</tr>

			<tr>
				<th> <img class="menuPhoto" src="../photos/platoVegano.jpg" alt="Plato vegano" /> </th>
				<th> <img class="menuPhoto" src="../photos/callos.jpg" alt="Callos caseros"/> </th>
			</tr>


		</table>
	</section>

	</section>
	<div class="button">
		<button class="button" type="button" onclick="loadDoc()">Conozca nuestros platos</button>
	</div>
	<br><br>
	<table class="description" id="demo"></table>

	<script>
		function loadDoc() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					myFunction(this);
				}
			};
			xhttp.open("GET", "menu.xml", true);
			xhttp.send();
		}
		function myFunction(xml) {
			var i;
			var xmlDoc = xml.responseXML;
			var table = "<tr><th>Plato</th><th>Alérgenos</th><th>Calorías</th><th>Precio</th><th>Descripción</th></tr>";
			var x = xmlDoc.getElementsByTagName("food");
			for (i = 0; i < x.length; i++) {
				table += "<tr><td>" +
					x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue +
					"</td><td>" +
					x[i].getElementsByTagName("allergens")[0].childNodes[0].nodeValue +
					"</td><td>" +
					x[i].getElementsByTagName("calories")[0].childNodes[0].nodeValue +
					"</td><td>" +
					x[i].getElementsByTagName("price")[0].childNodes[0].nodeValue +
					"</td><td>" +
					x[i].getElementsByTagName("description")[0].childNodes[0].nodeValue +
					"</td></tr>";
			}
			document.getElementById("demo").innerHTML = table;
		}
	</script>

	</section>

	<footer>
		<div class="footer">Estamos en Paseo Farnesio 19, 47013 Valladolid, España</div>
	</footer>

</body>

</html>