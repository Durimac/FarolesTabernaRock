

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

	const id_product = document.getElementById("modal_Adding_Container_ProductID").innerHTML;

	const numberOfLIs = document.getElementById("order_CurrentOrder_List").getElementsByTagName("li").length

	// If the currentOrderList is empty, we now show the Finish Order Button
	if (numberOfLIs == 0) {
		document.getElementById("order_CurrentOrder_FinishButton").style.visibility = "visible";
	}

	var currentOrderList = document.getElementById("order_CurrentOrder_List").innerHTML;

	const newProduct = `
			<li class="order_CurrentOrder_Product" id="order_CurrentOrder_Product_${numberOfLIs}" value="${numberOfLIs}">
				<img class="order_CurrentOrder_Product_DeleteButton" 
					src="../photos/Delete.png" 
					alt="Delete Button" 
					onclick="deleteProductFromOrder('${numberOfLIs}')"
				/>
				<div class="order_CurrentOrder_Product_NameAndPrice">
					<div class="order_CurrentOrder_Product_Name">
						${document.getElementById("modal_Adding_Container_Title").innerHTML} x${amount}
					</div>

					<div class="order_CurrentOrder_Product_Price">
						${document.getElementById("modal_Adding_Container_Price").innerHTML} 
					</div>
				</div>

				<div class="hidden">${id_product}-${amount}</div>
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


function deleteProductFromOrder(value) {
	// We first get the price of the product to delete and pass it (negatively) to "getTotal" function
	getTotal(parseFloat(document.getElementById(`order_CurrentOrder_Product_${value}`)
		.getElementsByClassName("order_CurrentOrder_Product_Price")[0].innerHTML) * -1);

	// Search the one to delete
	const indexToDelete = document.getElementById(`order_CurrentOrder_Product_${value}`).getAttribute("value");

	const numberOfLIs = document.getElementById("order_CurrentOrder_List").getElementsByTagName("li").length;
	
	// If the number of LIs is only one, we hide the Finish Button
	if (numberOfLIs == 1) {
		document.getElementById("order_CurrentOrder_FinishButton").style.visibility = "hidden";
	}

	// Change IDs of the rest of <li>
	for(i = 0 ; i < numberOfLIs ; i++) {
		if(i == indexToDelete) {
			// Get the whole list and delete the <li> required
			const currentOrderList = document.getElementById("order_CurrentOrder_List");
			currentOrderList.removeChild(currentOrderList.getElementsByTagName("li")[indexToDelete]);
		}
		else if(i > indexToDelete) {
			document.getElementById(`order_CurrentOrder_Product_${i}`).setAttribute("value", `${i - 1}`);
			document.getElementById(`order_CurrentOrder_Product_${i}`)
				.getElementsByTagName("img")[0]
				.setAttribute("onclick", `deleteProductFromOrder('${i - 1}')`);
			document.getElementById(`order_CurrentOrder_Product_${i}`).id = `order_CurrentOrder_Product_${i - 1}`;
		}
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


function getProductsFromOrder () {
	const numberOfLIs = document.getElementById("order_CurrentOrder_List").getElementsByTagName("li").length;

	var products = [];
	for(i = 0 ; i < numberOfLIs ; i++) {
		// Get ID & Amount from hidden div
		const idAndAmount = document.getElementById(`order_CurrentOrder_Product_${i}`)
			.getElementsByClassName("hidden")[0].innerHTML;

		const newProduct = {
			id_product: idAndAmount.substring(0, idAndAmount.indexOf("-")),
			amount: idAndAmount.substring(idAndAmount.indexOf("-")+1, idAndAmount.lenght)
		}
		products.push(newProduct);
	}

	return products;
}


// FASE DE PRUEBAS!!! NO FUNCIONA (bien al menos)
function sendFinishedOrder() {
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
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			closeModal("modal_FinishingOrder");
			alert("Pedido realizado correctamente! Te esperamos :P" + this.responseText)
		}
	};
	xmlhttp.open("GET", "sendFinishedOrder.php?clientInfo=&orderInfo=" + clientInfo + currentOrder, true);
	xmlhttp.send();
}