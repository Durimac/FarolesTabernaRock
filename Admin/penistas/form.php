<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/Azahar.php" />
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

	<body onload="disabler(true)">
        <h1 class="title_Name">Formulario</h1>
        <hr align="left" class="title_Underline">

        <div class="form-container">
            <h2>¡Únete a nuestra peña para pasar una fiestas inolvidables!</h2>

            <form action="procesamiento_formulario.php" target="_self" accept-charset="UTF-8" onreset="disabler(true)" method="post">
                <fieldset>
                    <legend>Informacion Personal:</legend>
                    Nombre:<br>
                    <input type="text" name="firstname" placeholder="Mickey" maxlength="50" required autofocus>
                    <br>
                    Apellidos:<br>
                    <input type="text" name="lastname" placeholder="Mouse Keyboard" maxlength="50" required>
                    <br>
                    Número de teléfono:<br>
                    <input type="text" name="phone_number" placeholder="666 777 888" maxlength="9" required>
                    <br>
                    Fecha de Naciemiento:<br>
                    <input type="date" name="birthDate" placeholder="01-01-1996" required maxlength="20">
                    <br>
                    Dirección de correo electrónico:<br>
                    <input type="email" name="email" maxlength="40" size="50">
                    <br>

                    <br>
                </fieldset>

                <p>¿Deseas vestir la vestimenta oficial de nuestro bar? Son solo 10€</p>
                <input type="radio" name="Clothes" value="Yes" onclick=disabler(true) checked> Yes<br>
                <input type="radio" name="Clothes" value="No" onclick=disabler(false)> No<br><br>

                <script>
                    function disabler(availability) {

                        if (availability) {
                            document.getElementById("sizex").disabled = false;
                            peñaFee = 50;
                        }
                        else {
                            document.getElementById("sizex").disabled = true;
                            document.getElementById("sizex").value = " ";
                            peñaFee = 40;
                        }
                        document.getElementById("price").innerHTML = ("Ingrese " + peñaFee + "€ en este numero de cuenta");
                    }
                </script>

                <script>
                    function resetConfirm() {
                        return confirm("ATENCION esta accion devolvera todos los campos a su valor inicial.¿Está seguro de que desea realizarla?");
                        }

                </script>


                <fieldset>
                    <legend>Vestimenta:</legend>
                    <p>Talla:</p>
                    <select name="size" size="1" id="sizex">
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
                </fieldset>
                <input type="checkbox" name="imageRights" value="Aceppt" required> Acepto la distribucion de
                imagenes en las que aparezca en la página web o las RRSS del bar<br>

                <input type="reset" onclick="return resetConfirm(); disabler(true);">
                <input type="submit" value="Submit">
            </form>
            <button name="cancel" onclick="javascript:window.history.back();">Cancelar</button>
        </div>
    </body>
</html>