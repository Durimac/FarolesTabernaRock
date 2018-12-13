function listPenistas() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ListaDeProductos").innerHTML = this.responseText;
        }
	};
	xmlhttp.open("GET","controller.php?action=showPenistas",true);
	xmlhttp.send();
}


function deletePenista(penistaID) {
	if (confirm("¡ATENCION! ¿Estás seguro de que deseas eliminar este peñista? Esta acción no se puede deshacer")) {
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
                alert("Peñista eliminado correctamente");
                location.reload();
            }
		};
		xmlhttp.open("GET","controller.php?action=deletePenista&idPenista=" + penistaID,true);
		xmlhttp.send();
	}
}


function editPenista(penID) {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			location.replace("./editPenistaForm.php");
		}
	};
	xmlhttp.open("GET","controller.php?action=editPenista&idPen=" + penID,true);
	xmlhttp.send();
}