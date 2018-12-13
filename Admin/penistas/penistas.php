<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/Azahar.php" />
                </head>
                <body>
                    <h1>No tienes permiso para ver esta página</h1>
                    <h2>Primero has de logearte en el sistema como Admin. Redireccionando...</h2>
                </body>
            </html>
        ';
        exit();
    }
?>
<?php include("../adminHeader.php")?>

    <div class="title">
        <h1 class="title_Name">Lista de Peñistas</h1>
        <img class="addButton" src="../../photos/Add.png" 
            onclick="window.location='../../contactPage/form.html'" alt="Añadir Peñista"/>
    </div>
    <hr align="left" class="title_Underline">

    <div class="container" id="ListaDeProductos"></div>

    <script src="./functions.js" type="text/javascript"></script>
    <script>
		listPenistas()
	</script>
</body>
</html>