<?php include("../../MySQL/mysqliFunctions.php"); ?>
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