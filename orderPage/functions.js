

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

	setTotal(document.getElementById("modal_Adding_Container_Price").innerHTML)

	closeModal("modal_Adding");
}


function setTotal(newAmount) {
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
	// We first get the price of the product to delete and pass it (negatively) to "setTotal" function
	setTotal(parseFloat(document.getElementById(`order_CurrentOrder_Product_${value}`)
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

	// And we fill some information in it
	document.getElementById("modal_FinishingOrder_Container_OrderInfo_Total").innerHTML =
		document.getElementById("order_CurrentOrder_Total").innerHTML;
	document.getElementById("modal_FinishingOrder_Container_Inputs_Comments").innerHTML = "";
	document.getElementById("modal_FinishingOrder_Container_OrderInfo_Comments_MaxChar").innerHTML = 
		"/" + document.getElementById("modal_FinishingOrder_Container_Inputs_Comments").getAttribute("maxlength");
	document.getElementById("modal_FinishingOrder_Container_OrderInfo_Comments_ActualChar").innerHTML = 
		document.getElementById("modal_FinishingOrder_Container_Inputs_Comments").value.length;
}

function setActualChar(textarea) {
	// Get the inner HTML for the text length
	const text = textarea.value.length;

	// Set the actual chars
	document.getElementById("modal_FinishingOrder_Container_OrderInfo_Comments_ActualChar").innerHTML = text;
}


function getProductsFromOrder () {
	const numberOfLIs = document.getElementById("order_CurrentOrder_List").getElementsByTagName("li").length;

	var productsDirectly = [];
	for(i = 0 ; i < numberOfLIs ; i++) {
		// Get ID & Amount from hidden div
		const idAndAmount = document.getElementById(`order_CurrentOrder_Product_${i}`)
			.getElementsByClassName("hidden")[0].innerHTML;

		const newProduct = {
			id_product: idAndAmount.substring(0, idAndAmount.indexOf("-")),
			amount: idAndAmount.substring(idAndAmount.indexOf("-")+1, idAndAmount.lenght)
		}
		productsDirectly.push(newProduct);
	}

	// It is possible to have more than one entry with the same id in the array. We place them together
	var products = [];
	for(i = 0 ; i < productsDirectly.length ; i++) {
		if(products.length == 0) {
			products.push(productsDirectly[i]);
		}
		else {
			var nonCoincidence = 0;
			for(j = 0 ; j < products.length ; j++) {
				// If the id is already in the final vector, then we plus both amounts
				if(products[j].id_product == productsDirectly[i].id_product) {
					products[j].amount = `${parseInt(products[j].amount) + parseInt(productsDirectly[i].amount)}`;
					break;
				}
				else {
					nonCoincidence++;
				}
			}
			// If the number of nonCoincidence is equal to the length of the vector it means there is a new ID. We add it
			if(nonCoincidence == products.length) {
				products.push(productsDirectly[i]);
			}
		}
	}

	return products;
}


function getTotalAmount() {
	var actualTotalPrice = document.getElementById("order_CurrentOrder_Total").innerHTML;
	if (actualTotalPrice) {
		actualTotalPrice = actualTotalPrice.replace("TOTAL: ", "");
	}
	return `${parseFloat(actualTotalPrice)}`;
}


function testEmptyness(array) {
	for(i = 0 ; i < array.length ; i++) {
		if(array[i] == null || array[i] == "") {
			return false;
		}
	}
	return true;
}


function sendFinishedOrder() {
	const pickUpDate = document.getElementById("modal_FinishingOrder_Container_PickUpDate").value;

	const products = getProductsFromOrder();

	const actualDate = new Date().getFullYear() + "-" +
		new Date().getMonth() + "-" +
		new Date().getDate() + " " +
		new Date().getHours() + ":" +
		new Date().getMinutes() + ":" +
		new Date().getSeconds();

	const clientInfo = {
		client_name: document.getElementById("modal_FinishingOrder_Container_FirstName").value,
		client_surname: document.getElementById("modal_FinishingOrder_Container_LastName").value,
		phone: document.getElementById("modal_FinishingOrder_Container_Phone").value,
		email: document.getElementById("modal_FinishingOrder_Container_Email").value,
		full_cost: getTotalAmount(),
		order_time: actualDate,
		pickup_time: "2018-12-09 14:24:00",
		order_state: "Nuevo",
		comments: document.getElementById("modal_FinishingOrder_Container_Inputs_Comments").value
	};

	// We test all the information introducer by the user is not empty
	if(!testEmptyness([clientInfo.client_name, 
		clientInfo.client_surname, 
		clientInfo.email, 
		clientInfo.phone, 
		clientInfo.pickup_time])) {
		alert("Algunos datos están incompletos");
		return;
	}

	const data = {
		products: products,
		clientInfo: clientInfo
	};

	var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			closeModal("modal_FinishingOrder");
			alert(this.responseText);
		}
	};
	request.open("POST", "sendFinishedOrder.php", true);
	request.setRequestHeader("Content-Type", "application/json");
	request.send(JSON.stringify(data));
}