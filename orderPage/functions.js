var currentOrder = [];

function fillMenuList(foodKindsList) {
	var kindsList = "";
	for (const kind of foodKindsList) {
		const newTypeItem = `
				<li class="order_Menu_Type">
					<h4 class="order_Menu_Type">${kind.kind}</h4>
					<ul class="order_Menu_ProductsList">${fillOneType(kind.productsList)}</ul>
				</li>
			`
		kindsList += newTypeItem;
		document.getElementById("order_Menu_Type").innerHTML = kindsList;
	}
}

function fillOneType(productsList) {
	var listItems = "";
	for (const product of productsList) {
		var newListItem = `
				<li class="order_Menu_Product">
					<div class="order_Menu_Product_Details">
						<div class="order_Menu_Product_Details_NameAndPrice">
							<div class="order_Menu_Product_Details_Name">${product.product_name}</div>
							<div class="order_Menu_Product_Details_Price">${product.price} €</div>
						</div>
						<div class="order_Menu_Product_Details_Description">${product.description}</div>
					</div>

					<div class="order_Menu_Product_AddButton">
						<img class="order_Menu_Product_AddButton" 
							src="../photos/Add.png" 
							alt="Add Button" 
							onclick="openModal_Adding('${product.product_name}', '${product.id_product}', '${product.price}')"
						/>
					</div>
				</li>
				<hr align="left" class="order_Menu_Product_Separator">
			`;
		listItems += newListItem;
	}
	return listItems;
}

function addProductToOrder() {
	const select_Amount = document.getElementById("select_Amount");
	const amount = select_Amount.options[select_Amount.selectedIndex].text;

	// Counter for ordering the Current Order List and update it
	const counter = parseInt(document.getElementById("order_CurrentOrder_Counter").innerHTML);
	document.getElementById("order_CurrentOrder_Counter").innerHTML = counter + 1;

	const id_product = document.getElementById("modal_Adding_Container_ProductID").innerHTML;

	// If the currentOrder is empty, we now show the Finish Order Button
	if (currentOrder.length == 0) {
		document.getElementById("order_CurrentOrder_FinishButton").style.visibility = "visible";
	}

	// Update the Current Order global variable (for traking the order)
	const newProductToOrder = {
		id_product: id_product,
		position: counter,
		amount: amount
	};
	currentOrder.push(newProductToOrder);

	var currentOrderList = document.getElementById("order_CurrentOrder_List").innerHTML;

	const newProduct = `
			<li class="order_CurrentOrder_Product" id="order_CurrentOrder_Product_${id_product}_${counter}_${amount}" value="${counter}">
				<img class="order_CurrentOrder_Product_DeleteButton" 
					src="../photos/Delete.png" 
					alt="Delete Button" 
					onclick="deleteProductFromOrder('${id_product}', '${counter}', '${amount}')"
				/>
				<div class="order_CurrentOrder_Product_NameAndPrice">
				<div class="order_CurrentOrder_Product_Name">
					${document.getElementById("modal_Adding_Container_Title").innerHTML} x${amount}
				</div>

				<div class="order_CurrentOrder_Product_Price" id="order_CurrentOrder_Product_Price_${id_product}_${counter}_${amount}">
					${document.getElementById("modal_Adding_Container_Price").innerHTML} 
				</div>
			</div>
			</li>
		`;

	currentOrderList += newProduct;
	document.getElementById("order_CurrentOrder_List").innerHTML = currentOrderList;

	getTotal(document.getElementById("modal_Adding_Container_Price").innerHTML)

	closeModal("modal_Adding");
}

function getTotal(newAmount) {
	var actualTotalPrice = document.getElementById("order_CurrentOrder_Total").innerHTML;
	if (actualTotalPrice) {
		actualTotalPrice = actualTotalPrice.replace("TOTAL: ", "");
	}
	else {
		actualTotalPrice = 0;
	}
	const totalPrice = parseFloat(actualTotalPrice) + parseFloat(newAmount);

	if (!totalPrice == 0) {
		document.getElementById("order_CurrentOrder_Total").innerHTML = `TOTAL:  ${parseFloat(totalPrice).toFixed(2)} €`;
	}
	else {
		document.getElementById("order_CurrentOrder_Total").innerHTML = "";
	}
}

function deleteProductFromOrder(id_product, position, amount) {
	// We first get the price of the product to delete and pass it (negatively) to "getTotal" function
	getTotal(parseFloat(document.getElementById(`order_CurrentOrder_Product_Price_${id_product}_${position}_${amount}`).innerHTML) * -1);

	// We hide and clean the List Item
	document.getElementById(`order_CurrentOrder_Product_${id_product}_${position}_${amount}`).className = "hidden";
	document.getElementById(`order_CurrentOrder_Product_${id_product}_${position}_${amount}`).innerHTML = "";

	// Now we need to update the Current Order global value, deleting one item from the array
	// If the array is only one, we empty the array directly and hide the Finish Order Button
	if (currentOrder.length == 1) {
		currentOrder = [];
		document.getElementById("order_CurrentOrder_FinishButton").style.visibility = "hidden";
	}
	// If lenght is more than one, we find the object we want to delete from the array and splice the array.
	else {
		const comparisonObject = {
			id_product: id_product,
			position: position,
			amount: amount
		};
		currentOrder.splice(currentOrder.
			findIndex(object => object === comparisonObject), 1);
	}
}

function openModal_Adding(productName, productID, productPrice) {
	document.getElementById("modal_Adding_Container_Title").innerHTML = `${productName}`;
	document.getElementById("modal_Adding_Container_ProductID").innerHTML = `${productID}`;
	document.getElementById("modal_Adding_Container_Price_OneProduct").innerHTML = `${productPrice}`;

	setPriceToAddingModal()
	// When the user clicks on the button, open the modal
	document.getElementById("modal_Adding").style.display = "block";
}

function closeModal(modal) {
	// When the user clicks on the button, close the modal
	document.getElementById(`${modal}`).style.display = "none";
}

function setPriceToAddingModal() {
	const productPrice = document.getElementById("modal_Adding_Container_Price_OneProduct").innerHTML;
	const select_Amount = document.getElementById("select_Amount");
	const amount = select_Amount.options[select_Amount.selectedIndex].text;
	const price = parseFloat(productPrice * amount).toFixed(2);
	document.getElementById("modal_Adding_Container_Price").innerHTML = `${price} €`;
}

function openModal_FinishingOrder() {
	// When the user clicks on the button, open the modal
	document.getElementById("modal_FinishingOrder").style.display = "block";
}


// FASE DE PRUEBAS!!! NO FUNCIONA (bien al menos)
function sendFinishedOrder () {
	const firstName = document.getElementById("modal_Adding_Container_FirstName").value;
	const lastName = document.getElementById("modal_Adding_Container_LastName").value;
	const email = document.getElementById("modal_Adding_Container_Email").value;
	const phone = document.getElementById("modal_Adding_Container_Phone").value;
	const pickUpDate = document.getElementById("modal_Adding_Container_PickUpDate").value;

	const clientInfo = {
		client_name: firstName,
		client_surname: lastName,
		email: email,
		phone: phone,
		pickup_time: pickUpDate 
	}

	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			closeModal("modal_FinishingOrder");
            alert("Pedido realizado correctamente! Te esperamos :P" + this.responseText)
		}
    };
    xmlhttp.open("GET", "sendFinishedOrder.php?clientInfo=&orderInfo=" + clientInfo + currentOrder, true);
    xmlhttp.send();
}