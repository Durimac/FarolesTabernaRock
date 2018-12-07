<?php include('../header.php'); ?>

	<!-- Main title and "underline" -->
	<h1 class="title_Name"> ¿Quiénes somos? </h1>
	<hr align="left" class="title_Underline">
	
	<section>

		<div class="events">
			<h2 class="events">Somos un negocio familiar</h2>
			<div class="history">
				<h4 class="events">Para comenzar a escribir sobre el origen de los bares debemos remontarnos bastantes años atrás. 
					Los primeros bares aparecen en el antiguo pueblo griego (época de Pompeya hasta la edad media) donde se desarrollaron 
					los establecimientos en los cuales se vendían bebidas. Desde entonces, poco ha evolucionado, hasta que nuestra pequeña familia, sí, esto
					es un negocio familiar, decidió mezclar lo mejor de la comida tradicional con los platos veganos, el rock y heavy con los juegos de mesa
					y el cerveceo tranquilo. De este modo surgió nuestra pequeña Faroles Taberna Rock </h4>
			</div>
		</div>

	</section>

	<div class="moviFotis">
		<img class="mySlides" src="../photos/gente.jpg" alt="En nuesta taberna hacemos hasta videoclips">
		<img class="mySlides" src="../photos/promo.jpg" alt="Rock y heavy, 2x1">
		<img class="mySlides" src="../photos/fotoGente.jpg" alt="Roqueros en nuestro bar"/>
		<img class="mySlides" src="../photos/fotoBarra.jpg" alt="Tomate tu caña tranquilamente"/>
	</div>

	<script>
		var myIndex = 0;
		carousel();

		function carousel() {
			var i;
			var x = document.getElementsByClassName("mySlides");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
			}
			myIndex++;
			if (myIndex > x.length) { myIndex = 1 }
			x[myIndex - 1].style.display = "block";
			setTimeout(carousel, 5000); // Change image every 5 seconds
		}
	</script>

	<script>
		window.alert("Estamos buscando camareros, si estas interesado manda tu CV a farolestabernarock@jemail.com");
	</script>


	<footer>
		<div class="footer">Estamos en Paseo Farnesio 19, 47013 Valladolid, España</div>
	</footer>
</body>

</html>