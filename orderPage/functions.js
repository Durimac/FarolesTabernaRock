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
	for (i = 0; i < numberOfLIs; i++) {
		if (i == indexToDelete) {
			// Get the whole list and delete the <li> required
			const currentOrderList = document.getElementById("order_CurrentOrder_List");
			currentOrderList.removeChild(currentOrderList.getElementsByTagName("li")[indexToDelete]);
		}
		else if (i > indexToDelete) {
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

	// Print calendar in there
	var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("modal_FinishingOrder_Container_Calendar").innerHTML = this.responseText;

			const today = new Date().getDate();
			const daysOfMonth = new Date(new Date().getFullYear(), new Date().getMonth()+1, 0).getDate();
			for(i = 1 ; i < today ; i++) {
				document.getElementById(`calendar_${i}`).className = "inactive-day";
			}

			for(i = today ; i <= daysOfMonth ; i++) {
				const activeDay = document.getElementById(`calendar_${i}`)
				activeDay.className = "active-day";
				activeDay.setAttribute("onclick", 'selectCalendarDay(this)');
			}
		}
	};
	request.open("GET", "calendar.php", true);
	request.send();

	// Print the Time selector
	const hour = new Date().getHours();
	const minutes = new Date().getMinutes() - (new Date().getMinutes()%5) + 5;

	var selector = `<select id="pickUpTime_Hours" name="Hours" autocomplete="off" onchange="seeRemainingTime()">`;
	for(i = 8 ; i < 24 ; i++) {
		if(i == hour && i < 10) {
			selector += `<option selected>0${i}</option>`;
		}
		else if (i == hour && i > 10) {
			selector += `<option selected>${i}</option>`;
		}
		else if (i != hour && i < 10) {
			selector += `<option>0${i}</option>`;
		}
		else {
			selector += `<option>${i}</option>`;
		}
	}
	selector += `</select><select id="pickUpTime_Minutes" name="Minutes" autocomplete="off" onchange="seeRemainingTime()">`;
	for(i = 0 ; i < 60 ; i += 5) {
		if(i == minutes && i < 10) {
			selector += `<option selected>0${i}</option>`;
		}
		else if (i == minutes && i > 10) {
			selector += `<option selected>${i}</option>`;
		}
		else if (i != minutes && i < 10) {
			selector += `<option>0${i}</option>`;
		}
		else {
			selector += `<option>${i}</option>`;
		}
	}
	selector += `</select>`;

	document.getElementById("modal_FinishingOrder_Container_PickUpTime").innerHTML = selector;

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


function getProductsFromOrder() {
	const numberOfLIs = document.getElementById("order_CurrentOrder_List").getElementsByTagName("li").length;

	var productsDirectly = [];
	for (i = 0; i < numberOfLIs; i++) {
		// Get ID & Amount from hidden div
		const idAndAmount = document.getElementById(`order_CurrentOrder_Product_${i}`)
			.getElementsByClassName("hidden")[0].innerHTML;

		const newProduct = {
			id_product: idAndAmount.substring(0, idAndAmount.indexOf("-")),
			amount: idAndAmount.substring(idAndAmount.indexOf("-") + 1, idAndAmount.lenght)
		}
		productsDirectly.push(newProduct);
	}

	// It is possible to have more than one entry with the same id in the array. We place them together
	var products = [];
	for (i = 0; i < productsDirectly.length; i++) {
		if (products.length == 0) {
			products.push(productsDirectly[i]);
		}
		else {
			var nonCoincidence = 0;
			for (j = 0; j < products.length; j++) {
				// If the id is already in the final vector, then we plus both amounts
				if (products[j].id_product == productsDirectly[i].id_product) {
					products[j].amount = `${parseInt(products[j].amount) + parseInt(productsDirectly[i].amount)}`;
					break;
				}
				else {
					nonCoincidence++;
				}
			}
			// If the number of nonCoincidence is equal to the length of the vector it means there is a new ID. We add it
			if (nonCoincidence == products.length) {
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
	for (i = 0; i < array.length; i++) {
		if (array[i] == null || array[i] == "") {
			return false;
		}
	}
	return true;
}

function testOnTime(hours, minutes) {
	const actualHour = new Date().getHours();
	const actualMinute = new Date().getMinutes();

	if(hours < actualHour) {
		return "La hora seleccionada ya pasó... Deberías mirar tu reloj de nuevo";
	}
	else {
		if(minutes <= actualMinute) {
			return "La hora seleccionada ya pasó... Deberías mirar tu reloj de nuevo";
		}
		else if (actualMinute - minutes < 30) {
			return "La hora seleccionada indica que quiere el pedido en menos de 30 minutos... Las cosas tardan en hacerse. Selecciones otra hora por favor";
		}
		else{
			return null;
		}
	}
}


function sendFinishedOrder() {
	var pickUpDay = document.getElementsByClassName("selected-day");

	if(pickUpDay.length == 0) {
		alert("Selecciona un día de entrega :)");
		return;
	}
	else {
		pickUpDay = pickUpDay[0].innerHTML;
	}

	const pickUpHours_Element = document.getElementById("pickUpTime_Hours");
	const pickUpMinutes_Element = document.getElementById("pickUpTime_Minutes");
	const pickUpHours = pickUpHours_Element.options[pickUpHours_Element.selectedIndex].value;
	const pickUpMinutes = pickUpMinutes_Element.options[pickUpMinutes_Element.selectedIndex].value;

	// Test the PickUpTime if the PickUpDay is today
	if(pickUpDay == new Date().getDate()) {
		const test = testOnTime(pickUpHours, pickUpMinutes);
		if(test != null) {
			alert(test);
			return;
		}
	}
	
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
		pickup_time: `${new Date().getFullYear()}-${new Date().getMonth()}-${pickUpDay} ${pickUpHours}:${pickUpMinutes}:00`,
		order_state: "Nuevo",
		comments: document.getElementById("modal_FinishingOrder_Container_Inputs_Comments").value
	};

	// We test all the information introducer by the user is not empty
	if (!testEmptyness([clientInfo.client_name,
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


function selectCalendarDay(day) {
	// Clear the day selected before
	const selectDay = document.getElementsByClassName("selected-day");
	if(selectDay.length != 0) {
		document.getElementsByClassName("selected-day")[0].className = "active-day";
	}

	// Select the day clicked
	day.className = "selected-day";

	seeRemainingTime();
}

function seeRemainingTime() {
	const day_Element = document.getElementsByClassName("selected-day");
	if(day_Element.length == 0) {
		return;
	}
	const pickUpDay = day_Element[0].innerHTML;
	const pickUpHours_Element = document.getElementById("pickUpTime_Hours");
	const pickUpMinutes_Element = document.getElementById("pickUpTime_Minutes");
	const pickUpHours = pickUpHours_Element.options[pickUpHours_Element.selectedIndex].value;
	const pickUpMinutes = pickUpMinutes_Element.options[pickUpMinutes_Element.selectedIndex].value;

	const millisecondRemaining = 
		new Date(`${new Date().getFullYear()}-${new Date().getMonth()+1}-${pickUpDay} ${pickUpHours}:${pickUpMinutes}:00`).valueOf()
		- new Date().valueOf();

	const daysLeft = (millisecondRemaining / (1000 * 60 * 60 * 24)).toFixed();
	var resto = millisecondRemaining % (1000 * 60 * 60 * 24);
	const hoursLeft = (resto / (1000 * 60 * 60)).toFixed();
	resto = resto % (1000 * 60 * 60);
	const minutesLeft = (resto / (1000 * 60)).toFixed();

	var timeLeft = "";
	// We write a string depending on the singluar or the plural for each case
	// Days
	if(daysLeft > 1) {
		if(hoursLeft != 0 && minutesLeft != 0) {
			timeLeft = `${daysLeft} días, `;
		}
		else if (hoursLeft != 0 || minutesLeft != 0) {
			timeLeft = `${daysLeft} días y `;
		}
		else {
			timeLeft = `${daysLeft} días.`;
		}
	}
	else if(daysLeft == 1) {
		if(hoursLeft != 0 && minutesLeft != 0) {
			timeLeft = `${daysLeft} día, `;
		}
		else if (hoursLeft != 0 || minutesLeft != 0) {
			timeLeft = `${daysLeft} día y `;
		}
		else {
			timeLeft = `${daysLeft} día.`;
		}
	}
	else {
		timeLeft = "";
	}

	// Hours
	if(hoursLeft > 1) {
		if(minutesLeft != 0) {
			timeLeft += `${hoursLeft} horas y `;
		}
		else {
			timeLeft += `${hoursLeft} horas.`;
		}
	}
	else if(hoursLeft == 1) {
		if(minutesLeft != 0) {
			timeLeft += `${hoursLeft} hora y `;
		}
		else {
			timeLeft += `${hoursLeft} hora.`;
		}
	}
	else {
		timeLeft += "";
	}

	// Minutes
	if(minutesLeft > 1) {
		timeLeft += `${minutesLeft} minutos.`;
	}
	else if(minutesLeft == 1) {
		timeLeft += `${minutesLeft} minuto.`;
	}
	else {
		timeLeft += "";
	}

	if(timeLeft != "") {
		document.getElementById("modal_FinishingOrder_Container_PickUpTime_Remaining").innerHTML = 
			`Está pidiendo el pedido para dentro de ${timeLeft}`;
	}
}