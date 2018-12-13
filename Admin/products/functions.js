function listarProductos() {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ListaDeProductos").innerHTML=xmlhttp.responseText;}
	};
	xmlhttp.open("GET","controller.php?action=show",true);
	xmlhttp.send();
}


function deleteProduct(productID) {
	if (confirm("¡ATENCION! ¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer")) {
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				alert("producto eliminado correctamente");
				location.reload();
			}
		};
		xmlhttp.open("GET","controller.php?action=delete&id=" + productID,true);
		xmlhttp.send();
	}
	//We will have to add the functionality to delete the image stored at the server associated to the product
}


function editProduct(productID) {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			window.location="./formulario_editar_producto.php";
		}
	};
	xmlhttp.open("GET","controller.php?action=edit&id=" + productID,true);
	xmlhttp.send();
}