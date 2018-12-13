function fillOrdersList(ordersStateList) {
	var statesList = "";
	for (const state of ordersStateList) {
		const newStateItem = `
				<li class="orders_StatesList">
					<h4 class="orders_StatesList_Title">Pedidos ${state.state}s</h4>
					<ul class="orders_StatesList_Orders">${fillOneState(state)}</ul>
				</li>
			`
        statesList += newStateItem;
		document.getElementById("orders_StatesList").innerHTML = statesList;
	}
}


function fillOneState(oneState) {
	var listItems = "";
	for (const order of oneState.ordersList) {
        const products = fillProductsFromOrder(order.products);
		var newListItem = `
                <li class="orders_StatesList_Orders_Order">
                    <div class="orders_StatesList_Orders_Order">
                        <div class="order-entry">PEDIDO Nº: <span class="order-entry">${order.id_order}</span></div>
                        <div class="order-entry">CLIENTE: <span class="order-entry">${order.client_name} ${order.client_surname}</span></div>
                        <div class="order-entry">TELÉFONO: <span class="order-entry">${order.phone}</span></div>
                        <div class="order-entry">EMAIL: <span class="order-entry">${order.email}</span></div>
                        <div class="order-entry">PARA EL: <span class="order-entry">${order.pickup_time}</span></div>
                        <div class="order-entry-comments">
                            <div class="order-entry">OBSERVACIONES:</div>
                            <div>${order.comments}</div>
                        </div>
                        <div class="order-entry">COMANDA: </div>
                        <div>${products}</div>
                    </div>
                    <button name="deleteOrder" id="${order.id_order}" onclick="deleteOrder(this)">Eliminar Pedido</button>
            `;
        if(oneState.state == "Confirmado") {
            newListItem += `
                    <button name="completeOrder" id="${order.id_order}" onclick="completeOrder(this)">Finalizar Pedido</button>
                </li>
            `;
        }
        else {
            newListItem += `
                    <button name="confirmOrder" id="${order.id_order}" onclick="confirmOrder(this)">Confirmar Pedido</button>
                </li>
            `;
        }
		listItems += newListItem;
	}
	return listItems;
}


function fillProductsFromOrder(products) {
    var productsList = "";
    for(i = 0 ; i < products.length ; i++) {
        productsList += `<p class="order-entry-product">${products[i].product_name} x${products[i].quantity}</p>`;
    }

    return productsList;
}


function confirmOrder(button) {
    const id_order = button.id;

    var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText != "" && this.responseText != null) {
                alert(this.responseText);
            }
            else {
                location.reload();
            }
		}
	};
	request.open("GET", `updateOrder.php?id_order=${id_order}&newState="Confirmado"`, true);
	request.send();
}


function completeOrder(button) {
    const id_order = button.id;

    var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText != "" && this.responseText != null) {
                alert(this.responseText);
            }
            else {
                location.reload();
            }
		}
	};
	request.open("GET", `updateOrder.php?id_order=${id_order}&newState="Completado"`, true);
	request.send();
}


function deleteOrder(button) {
    const id_order = button.id;
    
    if(confirm("¿Estás seguro que desea eliminar el pedido?")) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText != "" && this.responseText != null) {
                    alert(this.responseText);
                }
                else {
                    location.reload();
                }
            }
        };
        request.open("GET", `deleteOrder.php?id_order=${id_order}`, true);
        request.send();
    }
}