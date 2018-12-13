<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/index.php" />
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
<?php include('./controller.php'); ?>
<?php include("../adminHeader.php")?>

    <h1 class="title_Name">Lista de Pedidos</h1>
    <hr align="left" class="title_Underline">
    
    <div class="container">
        <ol class="orders_StatesList" id="orders_StatesList"></ol>
    </div>

    <script src="./functions.js" type="text/javascript"></script>
    <script>
		const ordersStateList = <?php echo json_encode($ordersStateList) ?>;
		fillOrdersList(ordersStateList);
	</script>
</body>
</html>