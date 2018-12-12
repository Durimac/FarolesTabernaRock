<?php include("../MySQL/mysqliFunctions.php"); ?>
<?php include('../header.php'); ?>

<html>

	<head>
        <h1 class="title_Name"> Buscador </h1>
	    <hr align="left" class="title_Underline">
	</head>

	<body>

        <h3 class="buscador">Búsqueda general: </h3>
        <form action = "resultado.php" method="post">
            <input class="text" name="search" tipe="text" size="15" maxlength="20">
            <input type="submit" value="Buscar"><br><br><br>
        </form>


        <h3 class="buscador">Búsqueda por nombre: </h3>
        <form action = "resultado.php" method="post">
            <input class="text" name="product_name_only" tipe="text" size="15" maxlength="20">
            <input type="submit" value="Buscar"><br>
        </form>

        <h3 class="buscador">Búsqueda por descripción: </h3>
        <form action = "resultado.php" method="post">
            <input class="text" name="description_only" tipe="text" size="15" maxlength="20">
            <input type="submit" value="Buscar"><br>
        </form>

        <h3 class="buscador">Búsqueda por precio: </h3>
        <form action = "resultado.php" method="post">
            <input class="text" name="price_only" tipe="text" size="15" maxlength="20">
            <input type="submit" value="Buscar"><br>
        </form>

        <h3 class="buscador">Búsqueda por tipo: </h3>
        <form action = "resultado.php" method="post">
            <input class="text" name="kind_only" tipe="text" size="15" maxlength="20">
            <input type="submit" value="Buscar"><br>
        </form>

        <h3 class="buscador">Búsqueda por calorías: </h3>
        <form action = "resultado.php" method="post">
            <input class="text" name="calories_only" tipe="text" size="15" maxlength="20">
            <input type="submit" value="Buscar"><br><br><br>
        </form>


        <h3 class="buscador">Búsqueda avanzada: </h3>
        <form action="resultado.php" method="post">
            <h3 class='buscadorAvanzado'>Búsqueda por nombre: </h3>
            <input class="textAvanzado" name="product_name" tipe="text" size="15" maxlength="20"><br>
            <h3 class="buscadorAvanzado">Búsqueda en la descripción: </h3>
            <input class="textAvanzado" name="description" tipe="text" size="15" maxlength="20"><br>
            <h3 class="buscadorAvanzado">Búsqueda por calorías: </h3>
            <input class="textAvanzado" name="calories" tipe="text" size="15" maxlength="20"><br>
            <h3 class="buscadorAvanzado">Búsqueda por precio: </h3>
            <input class="textAvanzado" name="price" tipe="text" size="15" maxlength="20"><br>
            <h3 class="buscadorAvanzado">Búsqueda por tipo: </h3>
            <input class="textAvanzado" name="kind" tipe="text" size="15" maxlength="20"><br>
            <input class="boton" type="submit" value="Buscar">
 
        </form>

        <?php


            /*
            @ $db = mysqli_connect('localhost', 'root', '', 'FarolesTabernaRock');
            mysqli_set_charset($db,"utf8");
            if	(!$db)
            {
                echo "<script type=\"text/javascript\">alert('No se ha podido conectar con la base de datos)</script>";
                exit;
            }
            */
            $db = connectDB();

            $query = "select * from food";

            $resultado = mysqli_query($db,$query);
            $num = mysqli_num_rows($resultado);
            

            for($i=0;$i<$num;$i++)
            {
                $fila=mysqli_fetch_array($resultado);
                
                $j = $i + 1;
                echo  "<h3 class=\"nombre\">$j: ".$fila['product_name']."</h3>";
                echo  "<img class='menuPhoto' src='../photos/FotosMenu/".$fila['image']."'/>";
                echo  "<h3 class=\"parrafo\">" .$fila['description']."</h3>";
                echo  "<h3 class=\"parrafo\">Precio: ".$fila['price']."</h3>";
                echo  "<h3 class=\"parrafo\">Calorias: ".$fila['calories']."</h3><br><br><br>";
            }          

            mysqli_close($db);
            
        ?>
    </body>
</html>