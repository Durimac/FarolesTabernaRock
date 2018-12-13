<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/Libertad.php" />
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

<?php include("../adminHeader.php")?>

	<script type="text/javascript">    
		function disabler(availability) {
			if (availability) {
				document.getElementById('fileToUpload').disabled = true;
				document.getElementById('actualImage').disabled = false;
				document.getElementById('instructions').innerHTML = ('');
				document.getElementById('instructions').value = 'fileToUpload';
			}
			else {
				document.getElementById('fileToUpload').disabled = false;
				document.getElementById('instructions').innerHTML = ('Seleccione la nueva imagen');
				document.getElementById('actualImage').disabled = true;
			}
		}
	</script>
	
	<h1 class="title_Name">Formulario</h1>
    <hr align="left" class="title_Underline">

    <div class="form-container">
		<h2>Editar Producto</h2>
		<form action='procesamiento_formulario_editarProducto.php' target='_self' accept-charset='UTF-8'  method='post' enctype='multipart/form-data' >
			<fieldset>
				<legend>Producto:</legend>
				Nombre del producto:<br>
				<input type='text' name='ProductName' value='<?php echo $_SESSION["product_name"]?>' maxlength='100' required autofocus>
				<br>
				Descripción:<br>
				<textarea name='Description' rows='5' cols='100' required><?php echo $_SESSION['description']?></textarea>
				<br>
				Calorias:<br>
				<input type='text' name='Calories' value=<?php echo $_SESSION['calories']?> maxlength='20' required>
				<br>
				Precio:<br>
				<input type='text' name='Price' value=<?php echo $_SESSION['price']?> required maxlength='20'>
				<br>
				Tipo:<br>
				<select  type='text' title='Tipo del producto' name='Kind'>
				<option value=<?php echo $_SESSION['kind']?> selected><?php echo $_SESSION['kind']?></option>
				<option id='carta'	value='Carta'>Carta</option>
				<option id='especialidad'	value='Especialidades'>Especialidades</option>
				<option id='hamburguesas'	value='Hamburguesas'>Hamburguesas</option>
				<option id='cartavegana'	value='Carta Vegana'>Carta Vegana</option>
				<option id='hamburguesavegana'	value='Hamburguesa Vegana'>Hamburguesa Vegana</option>
				</select><br>
				<!-- In the future, this function must get the kinds from the database and be able to create a new kind-->
				<br><br><br>
				<p>¿Deseas editar la imagen del producto?</p>
				<input type='radio' name='editImage' value='Yes' onclick=disabler(false) > Yes<br>
				<input type='radio' name='editImage' value='No' onclick=disabler(true) checked> No<br><br>
				Imagen actual: <input type='text' name='actualImage' id='actualImage' value=<?php echo $_SESSION['image']?> readonly maxlength='20'>
				<p id='instructions'></p>
				Foto:<BR><input title='Imagen del producto' type='file' name='fileToUpload' id='fileToUpload' disabled /><BR>
				<br><br>
				<input type='submit' value='Aceptar'>
			</fieldset>			
		</form>
		<button name="cancel" onclick="javascript:window.history.back()">Cancelar</button>
	</div>
</html>
							
			
