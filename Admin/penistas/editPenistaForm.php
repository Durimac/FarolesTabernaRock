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
	<body onload="disabler(true)">

    <h2>¡Únete a nuestra peña para pasar una fiestas inolvidables!</h2>

    <form action="processEditPenistaForm.php" target="_blank" accept-charset="UTF-8"  method="post">


        <fieldset>
            <legend>Informacion Personal:</legend>
            Nombre:<br>
            <input type="text" name="firstname" value='<?php echo $_SESSION["penista_name"]?>' maxlength="50" required autofocus>
            <br>
            Apellidos:<br>
            <input type="text" name="lastname" value='<?php echo $_SESSION["penista_surname"]?>' maxlength="50" required>
            <br>
            Número de teléfono:<br>
            <input type="text" name="phone_number" value='<?php echo $_SESSION["phone"]?>' required maxlength="9">
            <br>
            Fecha de Naciemiento:<br>
            <input type="date" name="birthDate" value='<?php echo $_SESSION["age"]?>' required maxlength="20">
            <br>
            Dirección de correo electrónico:<br>
            <input type="email" name="email" value='<?php echo $_SESSION["email"]?>' maxlength="40" size="50">
            <br><br>
        </fieldset>

        <!-- <fieldset> -->
        <p>¿Deseas vestir la vestimenta oficial de nuestro bar? Son solo 10€</p>
        <input type="radio" id="clothesYES" name="Clothes" value="Yes" onclick=disabler(true) > Yes<br>
        <input type="radio" id="clothesNO" name="Clothes" value="No" onclick=disabler(false)> No<br><br>
        <!-- </fieldset> -->

        <script>
            function disabler(availability) {
                if (availability) {
                    document.getElementById("sizex").disabled = false;
                    peñaFee = 50;
                    checker("Y");
                }
                else {
                    document.getElementById("sizex").disabled = true;
                    //document.getElementById("sizex").value = " ";
                    peñaFee = 40;
                    checker("N");
                }
                document.getElementById("price").innerHTML = ("Ingrese " + peñaFee + "€ en este numero de cuenta");
            }

            function checker(optionSelected){
                if (optionSelected=="Y"){
                    document.getElementById("clothesYES").checked = true;
                    document.getElementById("clothesNO").checked = false;
                    peñaFee = 50;
                }
                else if (optionSelected=="N"){
                    document.getElementById("clothesYES").checked = false;
                    document.getElementById("clothesNO").checked = true;
                    peñaFee = 40;
                }
                else {alert("vaya, parece que el valor no es correcto...");}
                document.getElementById("price").innerHTML = ("Ingrese " + peñaFee + "€ en este numero de cuenta");
            }
            checker("<?php echo $_SESSION["clothes"]?>");
        </script>

        <!-- <script>
            function resetConfirm() {
                return confirm("ATENCION esta accion devolvera todos los campos a su valor inicial.¿Está seguro de que desea realizarla?");
				}

        </script> -->


        <fieldset>
            <legend>Vestimenta:</legend>
            <p>Talla:</p>
            <select name="size" size="1" id="sizex">
            <option value=<?php echo $_SESSION['clothes_size']?> selected><?php echo $_SESSION['clothes_size']?></option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </fieldset>



        <fieldset>
            <legend>Informacion Bancaria:</legend>
            IBAN:<br>
            <input type="text" name="IBAN" value="ES6000491500051234567892	0049	1500	05	1234567892" size="65" readonly>
            <p id="price"></p>
            <!-- ¿EL Peñista ha pagado su cuota?
            <input type="radio"   value="Yes" onclick=cobradorFrac(true) > Yes<br>
            <input type="radio"   value="No" onclick=cobradorFrac(false)> No<br> -->
        </fieldset>
        <input type="checkbox" name="imageRights" value="Aceppt" checked> Acepto la distribucion de
        imagenes en las que aparezca en la página web o las RRSS del bar<br>

        

        <!--<input type="reset" onclick="return resetConfirm(); disabler(true);">-->
        <input type="submit" value="Aceptar">
    </form>

</body>

</html>