<?php include("../adminHeader.php")?>

    <div class="title">
        <h1 class="title_Name">Lista de Productos</h1>
        <img class="addButton" src="../../photos/Add.png" 
        onclick="location.href='formulario_aniadir_producto.php';" alt="Añadir Peñista"/>
    </div>
    <hr align="left" class="title_Underline">

    <div id="ListaDeProductos"></div>

    <script src="./functions.js" type="text/javascript"></script>
    <script>
        listarProductos()
    </script>
</body>
</html>