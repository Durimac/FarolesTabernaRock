<?php include("../../MySQL/mysqliFunctions.php"); ?>
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
<?php
    // Get the id_order from the GET request
    $id_order = $_GET["id_order"];
    $newState = $_GET["newState"];

    $db = connectDB();

    $query = "UPDATE orders SET order_state={$newState} WHERE id_order={$id_order}";
    $db->query($query);

    if($db->error) {
        echo "Ha ocurrido un error al modificar el estado del pedido: " . $db->error;
    }

    $db->close();
?>