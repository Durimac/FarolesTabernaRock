<?php include("../adminHeader.php")?>

    <h1 class="title_Name">Log In</h1>
    <hr align="left" class="title_Underline">
    
    <div>
        <fieldset style="color:white;">
            <legend>Información Personal</legend>
            Administrador:<br>
            <input type="text" name="Admin_Name"  maxlength="20" required autofocus>
            <br>
            Contraseña:<br>
            <input type="password" name="Admin_Pass"  maxlength="20" required>
            <br>
        </fieldset>
        <button name="logIn" onclick="logIn(this)">Entrar</button>
    </div>

    <script src="./functions.js" type="text/javascript"></script>
</body>
</html>