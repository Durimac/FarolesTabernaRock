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

        <h1 class="title_Name"> Menú </h1>
	    <hr align="left" class="title_Underline">
    
        <?php

            @ $search=$_POST['search'];
            @ $product_name_only=$_POST['product_name_only'];
            @ $product_name=$_POST['product_name'];
            @ $description_only=$_POST['description_only'];
            @ $description=$_POST['description'];
            @ $price_only=$_POST['price_only'];
            @ $price=$_POST['price'];
            @ $kind_only=$_POST['kind_only'];
            @ $kind=$_POST['kind'];
            @ $calories_only=$_POST['calories_only'];
            @ $calories=$_POST['calories'];


            $search=trim($search);
            $product_name_only=trim($product_name_only);
            $product_name=trim($product_name);
            $description_only=trim($description_only);
            $description=trim($description);
            $price_only=trim($price_only);
            $price=trim($price);
            $kind_only=trim($kind_only);
            $kind=trim($kind);
            $calories_only=trim($calories_only);
            $calories=trim($calories);

            if	((!$search) && (!$product_name_only) && (!$product_name) && (!$description_only ) && (!$description) && (!$price_only) && (!$price) && (!$kind_only) && (!$kind) && (!$calories_only) && (!$calories))
            {
                echo "No ha introducido ningún elemento de búsqueda"; 
                exit; 
            }

            $search=addslashes($search);
            $product_name_only=addslashes($product_name_only);
            $product_name=addslashes($product_name);
            $description_only=addslashes($description_only);
            $description=addslashes($description);
            $price_only=addslashes($price_only);
            $price=addslashes($price);
            $kind_only=addslashes($kind_only);
            $kind=addslashes($kind);
            $calories_only=addslashes($calories_only);
            $calories=addslashes($calories);


            @	$db	=	mysqli_connect('localhost',	'root',	'',	'FarolesTabernaRock');
            mysqli_set_charset($db,"utf8");
            if	(!$db)
            {
                echo	'Error:	No se ha podido	realizar la	conexión con la	Base de	Datos.';
                exit;
            }


            if ($search)
            {
                $query = "select * from food where product_name like '%$search%' OR description like '%$search%' OR calories like '%$search%' OR price like '%$search%' OR kind like '%$search%' ";
            }
            else if ($product_name_only)
            {
                $query = "select * from food where product_name like '%$product_name_only%' ";
            }
            else if ($description_only)
            {
                $query = "select * from food where description like '%$description_only%' ";
            }
            else if ($price_only)
            {
                $query = "select * from food where price like '%$price_only%' ";
            }
            else if ($kind_only)
            {
                $query = "select * from food where kind like '%$kind_only%' ";
            }
            else if ($calories_only)
            {
                $query = "select * from food where calories like '%$calories_only%' ";
            }
            else
            {
                $query = "select * from food where product_name like '%$product_name%' AND description like '%$description%' AND calories like '%$calories%' AND price like '%$price%' AND kind like '%$kind%' ";
            }

            
            $resultado = mysqli_query($db,$query);
            $num = mysqli_num_rows($resultado);
            
            if ($num==0)
            {
                echo "<script type=\"text/javascript\">alert('No se ha encontrado nada')</script>";
            }
            else
            {
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
            }
            
            mysqli_close($db);

        ?>
    </body>
</html>