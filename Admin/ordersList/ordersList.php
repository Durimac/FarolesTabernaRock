<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo 'No tiene permiso para acceder a esta página';
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