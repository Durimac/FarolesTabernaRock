<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo 'No tiene permiso para acceder a esta página';
        exit();
    }
?>
<?php include("../adminHeader.php")?>

    <div class="title">
        <h1 class="title_Name">Lista de Peñistas</h1>
        <img class="addButton" src="../../photos/Add.png" 
            onclick="location.href='../../contactPage/form.html';" alt="Añadir Peñista"/>
    </div>
    <hr align="left" class="title_Underline">

    <div id="ListaDeProductos"></div>

    <script src="./functions.js" type="text/javascript"></script>
    <script>
		listPenistas()
	</script>
</body>
</html>