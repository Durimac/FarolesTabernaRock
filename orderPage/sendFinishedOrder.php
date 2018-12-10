<?php include("../MySQL/mysqliFunctions.php"); ?>
<?php
    // Get the JSON in string format and then, decode it
    $data = json_decode(file_get_contents('php://input'));

    $clientInfo = $data->clientInfo;
    $products = $data->products;

    //First, we need to create a new entry in Orders Table
    $db = connectDB();

    // We know that Orders table has 9 entries. So we test it first
    if(count((array) $clientInfo) != 9) {
        echo "Error: Datos incompletos.";
        exit();
    }
    else {

    }

    // Normalize the data, adding slashes and trim the data
    $clientInfo = normalizeData($clientInfo);

    $db->query("INSERT into orders VALUES (
        NULL,
        '$clientInfo->client_name',
        '$clientInfo->client_surname',
        '$clientInfo->phone',
        '$clientInfo->email',
        '$clientInfo->full_cost',
        '$clientInfo->order_time',
        '$clientInfo->pickup_time',
        '$clientInfo->order_state',
        '$clientInfo->comments')"
    );

    if($db->error) {
        echo "Ha ocurrido un error en la inserción de los datos" . $db->error;
    }
    else {
        // All has been OK, so we notify the client
        echo "El pedido se ha realizado correctamente. ¡Te esperamos! :)";

        // Secondly, we need to add all the products to the order_food table
        // We need the ID of our last item inserted, in order to create order_food row
        $id_order = $db->insert_id;

        // Inserting all the products
        foreach($products as $index => $product) {
            $db->query("INSERT into order_food VALUES (
                '$id_order,
                '$product->id_product',
                '$product->amount'
            )");
        }
    }

    $db->close();
?>