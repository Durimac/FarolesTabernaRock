<?php include("../../MySQL/mysqliFunctions.php"); ?>
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
<?php
	if(!isset($_GET['action'])) {

	}
	else {
		$db = connectDB();
	
		switch($_GET['action']) {
			//-----------------------------------FUNCTION LIST PENISTAS------------------------------------------------------------------------
			case "showPenistas":
				$query = "SELECT * from penista";
				$result = mysqli_query($db,$query);
				
				echo "<table width=\"100%\" border=\"0\" cellpadding=\"5\">"; // open the table 

				echo " 
				<tr>
					<th>Borrar</th>
					<th align='left'>Nombre</th>
					<th align='left'>Apellidos</th>
					<th align='left'>Teléfono</th>
					<th align='left'>Fecha de Nacimiento</th>
					<th align='left'>Email</th>
					<th align='left'>Ropa</th>
					<th align='left'>Talla</th>
					<th>Editar</th>
				</tr>"; 
				while($row = mysqli_fetch_array($result)) {
					echo "
					<tr>
						<td>"."<img class='deleteButton'"."src='../../photos/Delete.png'"."alt='Delete Button'"."onclick='deletePenista(${row['id_penista']})'"."'/>"."</td>
						<td>".$row['penista_name']."</td>
						<td>".$row['penista_surname']."</td> 
						<td>".$row['penista_phone']."</td>
						<td>".$row['penista_age']."</td>  
						<td>".$row['penista_email']."</td> 
						<td>".$row['clothes']."</td>
						<td>".$row['clothes_size']."</td>
						<td>"."<img class='editButton'"."src='../../photos/Edit.png'"."alt='Edit Button'"." onclick='editPenista(${row['id_penista']})'"."'/>"."</td> 
					</tr>";
				}
				echo "</table>"; //close the table
				break;

			//-----------------------------------FUNCTION DELETE PENISTA------------------------------------------------------------------------
			case "deletePenista":
				if(isset($_GET['idPenista'])) {
					$idPenista = $_GET['idPenista'];
				}

				$query = "DELETE from penista WHERE id_penista=' ".$idPenista." '";
				$result = mysqli_query($db,$query);

				if($db->error) {
					echo "Ha ocurrido un error en la inserción de los datos" . $db->error;
				}
				break;
			
			//-----------------------------------FUNCTION EDIT PENISTA------------------------------------------------------------------------
			case "editPenista":
				if(isset($_GET['idPen'])) {
					$idPen = $_GET['idPen'];
				}

				$query = "SELECT * from penista WHERE id_penista=' ".$idPen." '";
				$result = mysqli_query($db,$query);
				
				while($row = mysqli_fetch_array($result)) {
					$_SESSION["penista_name"] = $row['penista_name'];
					$_SESSION["penista_surname"] = $row['penista_surname'];
					$_SESSION["phone"] = $row['penista_phone'];
					$_SESSION["age"] = $row['penista_age'];
					$_SESSION["email"] = $row['penista_email'];
					$_SESSION["clothes"] = $row['clothes'];
					$_SESSION["clothes_size"] = $row['clothes_size'];
					$_SESSION["id_penista"] = $row['id_penista'];		
				}
				break;
		}
		mysqli_close($db);
	}
?>