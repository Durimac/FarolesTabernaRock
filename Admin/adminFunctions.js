function confirmLogOut() {
    if(confirm("¿Estás seguro que desea salir del modo Administrador?")) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText != "" && this.responseText != null) {
                    alert(this.responseText);
                    window.location.replace("../../indexPage/index.php");
                }
                else {
                    window.location.replace("../../indexPage/index.php");
                }
            }
        };
        request.open("GET", `../adminFunctions.php?action="closeSesion"`, true);
        request.send();
    }
}