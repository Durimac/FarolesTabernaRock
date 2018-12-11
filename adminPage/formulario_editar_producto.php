<?php
session_start();
if(@$_SESSION['privilege']!=1)
{
	echo 'No tiene permiso para acceder a esta p&aacute;gina';
	exit();
}
if(isset($_GET['name'])){
$name=$_GET['name'];}
?>
<html>
<head>
    <meta charset="UTF-8" />
</head>
    <form action="procesamiento_formulario_editarProducto.php" target="_blank" accept-charset="UTF-8"  method="post" enctype="multipart/form-data">

        <fieldset>
            <legend>Nuevo Producto:</legend>
            Nombre del producto:<br>
            <input type="text" name="ProductName" value="<?php echo htmlspecialchars($name); ?>" maxlength="20" required autofocus>
            <br>
            Descripción:<br>
            <input type="text" name="Description" placeholder="$row['description']" maxlength="20" required>
            <br>
            Calorias:<br>
            <input type="text" name="Calories" placeholder="$row['calories']" maxlength="20" required>
            <br>
            Precio:<br>
            <input type="text" name="Price" placeholder="$row['price']" required maxlength="20">
            <br>
            <!-- Tipo:<br>
            <select name="Kind" size="1" >
                <option value="Carta">Carta</option>
                <option value="Especialidades">Especialidades</option>
                <option value="Hamburguesas">Hamburguesas</option>
                <option value="CartaVegana">CartaVegana</option>
                <option value="HamburguesaVegana">HamburguesaVegana</option>
            </select>-->
            <!-- In the future, this function must get the kinds from the database and be able to create a new kind-->
            <br><br><br>
            <!-- Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" required> -->
            
            <br><br>
            <input type="submit" value="Aceptar">
        </fieldset>
    </form>
</html>