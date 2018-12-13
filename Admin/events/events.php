<?php
    session_start();
    if(@$_SESSION['privilege'] != 1) {
        echo '
            <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=../index/Luna.php" />
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

    <h1 class="title_Name">Lista de Eventos</h1>
    <hr align="left" class="title_Underline">

    <div style="color:white; font-size:50px; display:flex; justify-content:center; width:100%;"> Page evolving to be as big as a Dinosaur </div>
    
</body>
</html>