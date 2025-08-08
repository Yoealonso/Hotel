<html>
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
    <header>
    <h3 class="inicio">HOTEL BELLA VISTA</h3>

     </header>
	<table border=1 width=30% class="table">
	<tr>
		  <td><center>Nombre</center></td>
		  <td><center>Apellido</center></td>
		  <td><center>Numero de habitación</center></td>
          <td><center>Tipo de habitación</center></td>
          <td><center>Detalles</center></td>
          <td><center>Inicio de la reserva</center></td>
          <td><center>Final de la reserva</center></td>
	</tr>

</body>
</html>

<?php
	include_once("C:/xampp/htdocs/Final(Edi-II)/Conexion/conexion.php");
	$consulta = mysqli_query($link,"  SELECT
        R.id AS reserva_id,
        U.name AS nombre_usuario,
        U.lastName AS apellido_usuario,
        RO.number AS numero_habitacion,
        RO.type AS tipo,
        RO.features AS detalles,
        R.fechaInicio,
        R.fechaFinal
    FROM
        reserves AS R
    INNER JOIN
        users AS U ON R.iduser = U.id
    INNER JOIN
        rooms AS RO ON R.idroom = RO.id
    ORDER BY
        R.fechaInicio DESC;");
	
	while ($fila=mysqli_fetch_array($consulta)) 
	{
		echo "<tr>
			  <td><center>$fila[1]</center></td>
			  <td><center>$fila[2]</center></td>
			  <td><center>$fila[3]</center></td>
              <td><center>$fila[4]</center></td>
              <td><center>$fila[5]</center></td>
              <td><center>$fila[6]</center></td>
              <td><center>$fila[7]</center></td>
              <tr>";

    }            

    echo"<a href='../paneladminitrador.html' class='button'>Volver al menu principal</a>";

?>
