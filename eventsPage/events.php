<?php include('../header.php'); ?>

	<!-- Main title and "underline" -->
	<h1 class="title_Name"> Eventos</h1>
	<hr align="left" class="title_Underline">

	<div class="events_Container">
		<div class="events_ComingNext">
			<h2 class="events_ComingNext"> Lo que se nos viene encima: </h2>

			<!-- Next events coming soon -->
			<ul class="events_ComingNext_List" id="events_ComingNext_List"></ul>
			<!-- Script to fill the List. For each event it creates a ListItem (<li></li>) with it's own class -->
			<script>
				const eventsList = [
					{ day: 18, month: "OCT", year: "2018", title: "Entrega de la Super Página Web", description: "En este gran día se hará la entrega de la página web de Los Faroles Taberna Rock." },
					{ day: 20, month: "OCT", year: "2018", title: "Concierto de Miguel Ríos", description: "No te pierdas el concierto inolvidable de Miguel Ríos aquí en Valladolid. Puede adquirir sus entradas en nuestro establecimiento." },
					{ day: 1, month: "NOV", year: "2018", title: "Hallowen Rockero", description: "En el día de Todos los Santos celebraremos un Halloween Rockero, donde podrás encontrar tanto a Lordi de tabernero, como a Lzzy Hale de camarera. ¡No te lo pierdas!" },
					{ day: 23, month: "DEC", year: "2018", title: "Cumpleaños de Darío Yuste", description: "El vigésimo segundo cumpleaños de un compañero extraordinario de Teleco, que actualmente se encuentra en Finlandia. Todos estáis invitados." }
				]

				var listItems = "";
				for (const event of eventsList) {
					var newListItem = `
						<li class="events_ComingNext_List">
							<div class="events_ComingNext_List_Date">
								<div class="events_ComingNext_List_Date_Day">${event.day}</div>
								<div class="events_ComingNext_List_Date_Month">${event.month}</div>
							</div>
							<div class="events_ComingNext_List_Description">
								<div class="events_ComingNext_List_Description_Title">
									<h4 class="events_ComingNext_List_Description_Title">${event.title}</h4>
									<h5 class="events_ComingNext_List_Description_Title">${daysLeftToEvent(event)}</h4>
								</div>
								<p class="events_ComingNext_List_Description">${event.description}</p>
							</div>
						</li>
					`;
					listItems += newListItem;
				}
				document.getElementById("events_ComingNext_List").innerHTML = listItems;

				function daysLeftToEvent(event) {
					const actualDate = new Date().valueOf();
					const eventDate = new Date(`${event.day} ${event.month} ${event.year}`).valueOf();
					const daysLeft = (eventDate - actualDate) / 1000 / 60 / 60 / 24;

					if (daysLeft < 0 && daysLeft > -1) {
						return `(¡ES HOY!)`;
					}
					else if (daysLeft <= -1) {
						return `(Lo sentimos, el evento ya ha acabado)`;
					}
					else {
						if (Math.ceil(daysLeft) == 1) {
							return `(Queda 1 día)`;
						}
						else {
							return `(Quedan ${Math.ceil(daysLeft)} días)`;
						}
					}
				}
			</script>
		</div>

		<div class="events_AlreadyGone">
			<h2 class="events_AlreadyGone">En anteriores capitulos: </h2>

			<div class="events_AlreadyGone_PhotoChanger">
				<button class="events_AlreadyGone_ButtonLeft" onclick="plusDivs(-1)">&#10094;</button>

				<img class="events_AlreadyGone_Photos" src="../photos/copazo.jpg" alt="Foto tomando una copa en nuestro ambiente rockero">
				<img class="events_AlreadyGone_Photos" src="../photos/cantante.jpg" alt="Foto cantante amenizando nuestro ambiente">
				<img class="events_AlreadyGone_Photos" src="../photos/cerveza.jpg" alt="Foto disfrutando de una buena cerveza">
				<img class="events_AlreadyGone_Photos" src="../photos/barra.jpg" alt="Foto de nuestra barra, elige tu bebida y a disfrutar">

				<button class="events_AlreadyGone_ButtonRight" onclick="plusDivs(1)">&#10095;</button>
			</div>
		</div>
	</div>




	<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
			showDivs(slideIndex += n);
		}

		function showDivs(n) {
			var i;
			var x = document.getElementsByClassName("events_AlreadyGone_Photos");
			if (n > x.length) { slideIndex = 1 }
			if (n < 1) { slideIndex = x.length }
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
			}
			x[slideIndex - 1].style.display = "block";
		}

	</script>

	<footer>
		<div class="footer">Estamos en Paseo Farnesio 19, 47013 Valladolid, España</div>
	</footer>
</body>

</html>