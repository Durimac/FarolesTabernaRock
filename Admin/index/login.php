<?php include("../../MySQL/mysqliFunctions.php"); ?>
<?php
    session_start();
    
    $login = $_GET['Admin_Name'];
    $password = $_GET['Admin_Pass'];

    $login = normalizeData($login);
    $password = normalizeData($password);

    if(!$login || !$password) {
        echo "Hay campos vacíos.";
        exit();
    }

    $db = connectDB();

    //Consulta para comprobar campos repetidos
    $query = "SELECT * FROM administrator WHERE admin_username='$login' AND admin_password='$password'";
    $result = mysqli_query($db, $query);
    $numerOfRows = mysqli_num_rows($result);
    if($numerOfRows != 1) {
        echo $login . " " . $password;
        echo "El nombre o la contraseña no coinciden, comprueba los datos. {$numerOfRows}";
    }
    else {
        $row = mysqli_fetch_array($result);
        $_SESSION['login'] = $login;
        $_SESSION['privilege'] = $row['admin_power'];
    }

    $db->close();
?>