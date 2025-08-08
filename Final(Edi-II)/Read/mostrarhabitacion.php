
<html>
<head>
 <head>
 <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Reservas del hotel</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../style.css'>
    <script src='main.js'></script>
    <title>Mis Reservas</title>
</head>

<body>


	<tr>
		  <td><center>numero</center></td>
		  <td><center>tipo</center></td>
		  <td><center>detalles</center></td>
		  
		  </tr>";
</body>
</html>

<?php
	include_once("C:/xampp/htdocs/Final(Edi-II)/Conexion/conexion.php");
	$consulta = mysqli_query($link,"SELECT * FROM rooms");
	while ($fila=mysqli_fetch_array($consulta)) 
	{
		echo "<tr>
			  <td><center>$fila[1]</center></td>
			  <td><center>$fila[2]</center></td>
			  <td><center>$fila[3]</center></td>
              <tr>";

    }            
?>

<a href="../Create/cargarusuario.php" class="button">Cargar otra habitación</a>
<a href="../Delete/eliminarhabitacion.php" class="button">Eliminar habitación</a>
<a href="../paneladminitrador.html" class="button">Volver al menu principal</a>