<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo 'No tiene permiso para acceder a esta p&aacute;gina';
        exit();
    }
?>
<html>
<head>
    <meta charset="UTF-8" />
</head>
    <form action="procesamiento_formulario_addProducto.php" target="_blank" accept-charset="UTF-8"  method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Nuevo Producto:</legend>
            Nombre del producto:<br>
            <input type="text" name="ProductName" placeholder="Tortilla de Patata" maxlength="20" required autofocus>
            <br>
            Descripción:<br>
			<textarea name='Description' rows='5' cols='100' placeholder="La mejor tortilla de patata de valladolid, con huevo, cebolla y patata" required ></textarea>
			<br>
            Calorias:<br>
            <input type="text" name="Calories" placeholder="100" maxlength="20" required>
            <br>
            Precio:<br>
            <input type="text" name="Price" placeholder="5" required maxlength="20">
            <br>
            Tipo:<br>
            <select name="Kind" size="1" >
                <option value="Carta">Carta</option>
                <option value="Especialidades">Especialidades</option>
                <option value="Hamburguesas">Hamburguesas</option>
                <option value="Carta Vegana">Carta Vegana</option>
                <option value="Hamburguesa Vegana">Hamburguesa Vegana</option>
            </select>
            <!-- In the future, this function must get the kinds from the database and be able to create a new kind-->
            <br><br><br>
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <br><br>
            <input type="submit" value="Aceptar">
        </fieldset>
    </form>
</html>
