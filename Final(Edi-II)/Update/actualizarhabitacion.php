<?php
include_once("../Conexion/conexion.php");

$number = "";
$type = "";
$features = "";
$id_habitacion = 0; //Valor por defecto.

/*--------------------------------Mostrar habitacion-------------------------------------------*/
	$consulta = mysqli_query($link,"SELECT * FROM rooms");
	
	echo "<table border=1 width=30%>";
	echo "<tr>
		  <td><center>numero</center></td>
		  <td><center>tipo</center></td>
		  <td><center>detalles</center></td>
		  
		  </tr>";

	while ($fila=mysqli_fetch_array($consulta)) 
	{
		echo "<tr>
			  <td><center>$fila[1]</center></td>
			  <td><center>$fila[2]</center></td>
			  <td><center>$fila[3]</center></td>
              <tr>";

    }       

/*------------------------------------------------------------------------------------------------*/
echo "Seleccione la habitación que desea acrualizar:  ";

$usuarios = mysqli_query($link, "SELECT * FROM rooms");
echo "<select id='habitacion' name='habitacion'>"; 
$id_habitacion = 0;
while ($fila = mysqli_fetch_assoc($usuarios)) {
    echo "<option value='" . $fila['id'] . "'>" . $fila['number'] . "</option>";
    $id_habitacion = $fila['id'];
}
echo "</select>";



if (isset($_POST["enviar"])) {
    $number = $_POST['number'];
    $type = $_POST['type'];
    $features = $_POST['features'];

    $query = "UPDATE rooms SET number = '$number', type = '$type', features = '$features' where id ='$id_habitacion'";
    if (mysqli_query($link, $query)) {
        echo "Habitación actualizada con éxito.";
        exit;
    } else {
        echo "Error al actualizar la habitación: " . mysqli_error($link);
    }    
}
?>
	<head>
    <meta charset='UTF-8'>
   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <link rel='stylesheet' type='text/css' media='screen' href='../style.css'>
    <title>Mis Reservas</title>
	<table border=1 width=30% class="table">
	</head>
 <form method="POST">

<label>Actualice el numero de habitacion:</label>		 	
<input type="number" name="number"><br><br>
<label>Ingrese que tipo de habitacion es:</label>
<input type="text" name="type"><br><br>
<label>Ingrese los detalles de la habitacion:</label>		 	
<input type="text" name="features"><br><br>

<input type="hidden" name="habitacion" value="<?php echo $id_habitacion; ?>">

<input type="submit" name="enviar" value="enviar">

 </form>

 <a href="actualizarhabitacion.php" class="button">Volver</a>
 <a href="../paneladminitrador.html" class="button">Volver al menu principal</a>