<?php 
include_once("C:/xampp/htdocs/Final(Edi-II)/Conexion/conexion.php"); 


if (isset($_POST["enviar"])) {
	$number = $_POST["number"];
    $type = $_POST["type"];
    $features = $_POST["features"];
    
	if (empty($number) || empty($type) || empty($features)) {
        echo '<script type="text/javascript">
		 alert ("Todos los campos son obligatorios");
		 window.location.href="cargarhabitacion.php";
		</script>
        exit()';
    }
	
	$cadena = "INSERT INTO rooms(number, type, features) VALUES('$number', '$type', '$features')";

	$consulta = mysqli_query($link,$cadena);

    if ($consulta)
	{	

		echo '<script type="text/javascript">
		 alert ("Exito al cargar la habitación");
		 window.location.href="../Read/mostrarhabitacion.php";
		</script>';
	
        }else{

		echo "<script> alert('todo mal')></script>";
	}
}


 ?>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Reservas de hotel</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../style.css'>
    <script src='main.js'></script>
</head>
   
 <form method="POST">
<h2>Complete los campos para cargar una nueva habitación</h2>
<label>Ingrese el numero de la habitación:</label>		 	
<input type="number" name="number" required min="1" max="40"><br><br>
<label>Ingrese que tipo de habitacion es:</label>
<input type="text" name="type" required><br><br>
<label>Ingrese los detalles de la habitacion:</label>		 	
<input type="text" name="features" required><br>

<div class="links">
<input type="submit" name="enviar" value="Enviar">

<br><a href="../Read\mostrarhabitacion.php">Ver todas las habitaciones</a><br><br>
 <a href="../paneladminitrador.html">Volver al menu principal</a>
</div>
 </form>

 