<?php
    function connectDB() {
        //$hostDB="vulcano.tel.uva.es";
        //$loginDB="taw010";
        //$passDB="3eo0u4b9";
        $hostDB="localhost";
        $loginDB="root";
        $passDB="";
        $nameDB="FarolesTabernaRock";

        @ $db = mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
        if(!$db) {
            /* Dario's parammeters for the MySQL server. Otherwise it will not work for me (Dar�o) */
            $hostDB="127.0.0.1";
            $passDB="root";
            @ $db = mysqli_connect($hostDB, $loginDB, $passDB, $nameDB);
            if(!$db) {
                echo "No fue posible conectarse con la base de Datos " .  $db->connect_error();
                exit();
            }
        }
        $db->set_charset("utf8");

        return $db;
    }

    function normalizeData($var) {
        if(gettype($var) == "object") {
            foreach($var as $key => $value) {
                if($value != NULL) {
                    $value = trim($value);
                    $value = addslashes($value);
                    $var->$key = $value;
                }
            }
            return $var;
        }
        else if (gettype($var) == "array") {
            foreach($var as $index => $value) {
                if($value != NULL) {
                    $value = trim($value);
                    $value = addslashes($value);
                    $var[$index] = $value;
                }
            }
            return $var;
        }
        else {
            $var = trim($var);
            $var = addslashes($var);
            return $var;
        }
    }
?>