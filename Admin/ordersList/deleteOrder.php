<?php include("../../MySQL/mysqliFunctions.php"); ?>
<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/index.php" />
                    <meta charset="UTF-8" />
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

    $db = connectDB();

    // We need to delete the Order from Orders table
    $query = "DELETE from orders WHERE id_order={$id_order}";
    $db->query($query);

    if($db->error) {
        echo "Ha ocurrido un error al borrar el pedido: " . $db->error;
    }

    // We need to delete the Products from the Order from Order_Food table
    $query = "DELETE from order_food WHERE id_order={$id_order}";
    $db->query($query);

    if($db->error) {
        echo "Ha ocurrido un error al borrar el pedido: " . $db->error;
    }

    $db->close();
?>