<?php include('./controller.php'); ?>
<?php include('../header.php'); ?>

	<h1 class="title_Name">Realiza tu pedido</h1>
	<hr align="left" class="title_Underline">

	<div class="order_Container">
		<div class="order_Menu">
			<ul class="order_Menu_Type" id="order_Menu_Type"></ul>
		</div>
		<div class="order_CurrentOrder">
			<h4 class="order_CurrentOrder_Title">Pedido actual</h4>
			<hr class="order_CurrentOrder_Title">
			<div class="hidden" id="order_CurrentOrder_Counter">0</div>
			<ol class="order_CurrentOrder_List" id="order_CurrentOrder_List"></ol>
			<h4 class="order_CurrentOrder_Total" id="order_CurrentOrder_Total"></h4>
			<div class="order_CurrentOrder_FinishButton" id="order_CurrentOrder_FinishButton">
				<span class="order_CurrentOrder_FinishButton" onClick="openModal_FinishingOrder()">Finalizar Pedido</span>
			</div>
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
					<select name="select_Amount" id="select_Amount" onchange="setPriceToAddingModal()">
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

			<div class="hidden" id="modal_Adding_Container_ProductID"></div>
			<div class="hidden" id="modal_Adding_Container_Price_OneProduct"></div>

			<div class="modal_Adding_Container_Buttons">
				<button class="modal_Adding_Container_Button" onclick="closeModal('modal_Adding')">Cancelar</button>
				<button class="modal_Adding_Container_Button" onclick="addProductToOrder()">AÃ±adir</button>
			</div>
		</div>
	</div>

	<!-- FINISHING ORDER MODAL -->
	<div class="modal_Adding_Bacground" id="modal_FinishingOrder">
		<!-- Modal content -->
		<div class="modal_Adding_Container">
			<input type="text" autofocus placeholder="Nombre" id="modal_Adding_Container_FirstName">
			<input type="text" placeholder="Apellido" id="modal_Adding_Container_LastName">
			<input type="email" placeholder="Email" id="modal_Adding_Container_Email">
			<input type="text" placeholder="Nº Móvil" id="modal_Adding_Container_Phone">
			<input type="date" placeholder="Fecha Recogida" id="modal_Adding_Container_PickUpDate">
			<div class="modal_Adding_Container_Buttons">
				<button class="modal_Adding_Container_Button" onclick="closeModal('modal_FinishingOrder')">Cancelar</button>
				<button class="modal_Adding_Container_Button" onclick="sendFinishedOrder()">Confirmar</button>
			</div>
		</div>
	</div>

	<script src="./functions.js" type="text/javascript"></script>
	<script>
		const foodKindsList = <?php echo json_encode($foodKindsList) ?>;
		fillMenuList(foodKindsList);
	</script>

</body>

</html>