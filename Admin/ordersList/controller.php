<?php include("../../MySQL/mysqliFunctions.php"); ?>
<?php
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
    $db = connectDB();

    // We get the kinds of food that are stored in the data base
    $differentStates = get_DifferentState($db);
    if($differentStates != null) {
        $ordersStateList = array();
        // After getting the food kinds, we fill a matrix with each kind of food and its own products List
        foreach($differentStates as $index => $column) {
            $ordersStateList[] = array('state' => $column, 'ordersList' => get_OrdersFroomState($db, $differentStates[$index]));
        }
    }
    
    // We close the connection with the DB 
    $db->close();

    /* Function for getting the states of orders that are stored in the DB */
    function get_DifferentState($db) {
        $query = "SELECT order_state FROM orders";
        $result = $db->query($query);
        
        if ($result->num_rows > 0) {
            $differentStates = array();
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // This checks also if the State is Completed, if so, it does not get it
                if(!in_array($row['order_state'], $differentStates) && $row['order_state'] != "Completado") {
                    $differentStates[] = $row['order_state'];
                }
            }
            return $differentStates;
        } 
        else {
            return null;
        }
    }

    /* Function for getting the orders list of each state of order that are stored in the DB */
    function get_OrdersFroomState($db, $order_state) {
        $query = "SELECT * FROM orders WHERE order_state='$order_state'";
        $result = $db->query($query);

        if($result->num_rows > 0) {
            $ordersFromState = array();
            while($row = $result->fetch_assoc()) {
                $row['products'] = get_ProductsFromOrder($db, $row['id_order']);
                $ordersFromState[] = $row;
            }

            return $ordersFromState;
        }
        else {
            echo "0 ordersFromState";
        }
    }


    function get_ProductsFromOrder($db, $id_order) {
        $query = "SELECT * FROM order_food WHERE id_order='$id_order'";
        $result = $db->query($query);

        if($result->num_rows > 0) {
            $orderProducts = array();
            while($row = $result->fetch_assoc()) {
                $row['product_name'] = get_ProductName($db, $row['id_product']);
                $orderProducts[] = $row;
            }

            return $orderProducts;
        }
        else {
            echo "0 ProductsFromOrder";
        }
    }


    function get_ProductName($db, $id_product) {
        $query = "SELECT * FROM food WHERE id_product='$id_product'";
        $result = $db->query($query);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            return $row['product_name'];
        }
        else {
            echo "0 Product Name";
        }
    }
?>