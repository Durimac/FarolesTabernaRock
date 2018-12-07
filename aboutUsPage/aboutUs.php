<?php include('../header.php'); ?>

	<!-- Main title and "underline" -->
	<h1 class="title_Name"> �Qui�nes somos? </h1>
	<hr align="left" class="title_Underline">
	
	<section>

		<div class="events">
			<h2 class="events">Somos un negocio familiar</h2>
			<div class="history">
				<h4 class="events">Para comenzar a escribir sobre el origen de los bares debemos remontarnos bastantes a�os atr�s. 
					Los primeros bares aparecen en el antiguo pueblo griego (�poca de Pompeya hasta la edad media) donde se desarrollaron 
					los establecimientos en los cuales se vend�an bebidas. Desde entonces, poco ha evolucionado, hasta que nuestra peque�a familia, s�, esto
					es un negocio familiar, decidi� mezclar lo mejor de la comida tradicional con los platos veganos, el rock y heavy con los juegos de mesa
					y el cerveceo tranquilo. De este modo surgi� nuestra peque�a Faroles Taberna Rock </h4>
			</div>
		</div>

	</section>

	<div class="moviFotis">
		<img class="mySlides" src="../photos/gente.jpg" alt="En nuesta taberna hacemos hasta videoclips">
		<img class="mySlides" src="../photos/promo.jpg" alt="Rock y heavy, 2x1">
		<img class="mySlides" src="../photos/fotoGente.jpg" alt="Roqueros en nuestro bar"/>
		<img class="mySlides" src="../photos/fotoBarra.jpg" alt="Tomate tu ca�a tranquilamente"/>
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
		<div class="footer">Estamos en Paseo Farnesio 19, 47013 Valladolid, Espa�a</div>
	</footer>
</body>

</html>