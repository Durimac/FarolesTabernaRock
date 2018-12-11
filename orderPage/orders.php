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
				<button class="modal_Adding_Container_Button" onclick="addProductToOrder()">Añadir</button>
			</div>
		</div>
	</div>

	<!-- FINISHING ORDER MODAL -->
	<div class="modal_FinishingOrder_Bacground" id="modal_FinishingOrder">
		<!-- Modal content -->
		<div class="modal_FinishingOrder_Container">
			<h3 class="modal_FinishingOrder_Container_Title">Rellene la información personal de su pedido</h3>

			<div class="modal_FinishingOrder_Container_InputsAndOrderInfo">
				<div class="modal_FinishingOrder_Container_Inputs">
					<h5 class="modal_FinishingOrder_Container_Inputs_Title">Nombre</h5>
					<input class="modal_FinishingOrder_Container_Inputs_Input" type="text" required 
						id="modal_FinishingOrder_Container_FirstName">
					<h5 class="modal_FinishingOrder_Container_Inputs_Title">Apellidos</h5>
					<input class="modal_FinishingOrder_Container_Inputs_Input" type="text" required
						id="modal_FinishingOrder_Container_LastName">
					<h5 class="modal_FinishingOrder_Container_Inputs_Title">Email</h5>
					<input class="modal_FinishingOrder_Container_Inputs_Input" type="email" required
						id="modal_FinishingOrder_Container_Email">
					<h5 class="modal_FinishingOrder_Container_Inputs_Title">Número Teléfono</h5>
					<input class="modal_FinishingOrder_Container_Inputs_Input" type="text" required
						id="modal_FinishingOrder_Container_Phone">
					<h5 class="modal_FinishingOrder_Container_Inputs_Title">Fecha de recogida</h5>
					<input class="modal_FinishingOrder_Container_Inputs_Input" type="text" required
						placeholder="yyyy-mm-dd hh:mm:ss" id="modal_FinishingOrder_Container_PickUpDate">
				</div>

				<div class="modal_FinishingOrder_Container_OrderInfo">
					<h4 class="modal_FinishingOrder_Container_OrderInfo_Title">Información del pedido</h4>
					<h3 class="modal_FinishingOrder_Container_OrderInfo_Total" id="modal_FinishingOrder_Container_OrderInfo_Total"></h3>
					<div class="modal_FinishingOrder_Container_OrderInfo_Comments">
						<h5 class="modal_FinishingOrder_Container_Inputs_Title">Observaciones</h4>
						<textarea class="modal_FinishingOrder_Container_Inputs_Comments" 
							id="modal_FinishingOrder_Container_Inputs_Comments"
							placeholder="Por ejemplo: La Hamburguesa sin cebolla..."
							cols="40" rows="7" maxlength="250" onkeyup="setActualChar(this)"
						>
						</textarea>
						<div class="modal_FinishingOrder_Container_OrderInfo_Comments_ActualChar">
							<span id="modal_FinishingOrder_Container_OrderInfo_Comments_ActualChar"></span>
							<span id="modal_FinishingOrder_Container_OrderInfo_Comments_MaxChar"></span>
						</div>
					</div>
				</div>
			</div>

			<div class="modal_FinishingOrder_Container_Buttons">
				<button class="modal_FinishingOrder_Container_Button" onclick="closeModal('modal_FinishingOrder')">Cancelar</button>
				<button class="modal_FinishingOrder_Container_Button" onclick="sendFinishedOrder()">Confirmar</button>
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