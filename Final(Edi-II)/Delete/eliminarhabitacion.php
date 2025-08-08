
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<link rel='stylesheet' type='text/css' media='screen' href='../style.css'>
<script src='main.js'></script>
<title>Mis Reservas</title>
</head>
<body>
<table border=1 width=30% class='table'>
<section>
<h2>Eliminar habitación</h2>
<p>Seleccione la habitación que desea eliminar:</p>

<?php
include_once("../Conexion/conexion.php"); 
//------------------------------------------- Select de habitación -------------------------------------------
$usuarios = mysqli_query($link, "SELECT * FROM rooms");

echo "<select id='habitacion'>";
while ($fila = mysqli_fetch_assoc($usuarios)) {
    echo "<option value='" . $fila['id'] . "'>" . $fila['number'] . "</option>";
}
//-------------------------------------------------------------------------------------

?>
</section>
</select>

<br><button onclick='eliminarHabitacion()' class="button">Eliminar Habitación</button>

<script>
function eliminarHabitacion() {
    var habitacionSelect = document.getElementById("habitacion");
    var idHabitacion = habitacionSelect.value;

    var confirmacion = confirm("¿Seguro que desea eliminar la habitación con ID: " + idHabitacion + "?");

    if (confirmacion) {
       var formulario = document.createElement("form");
        formulario.method = "post";
        formulario.action = "";

        var inputId = document.createElement("input");
        inputId.type = "hidden";
        inputId.name = "id_habitacion";
        inputId.value = idHabitacion;

        formulario.appendChild(inputId);

        var inputEliminar = document.createElement("input");
        inputEliminar.type = "hidden";
        inputEliminar.name = "eliminar_habitacion";
        inputEliminar.value = "1";
        formulario.appendChild(inputEliminar);

        document.body.appendChild(formulario);
        formulario.submit();
    }
}
</script>

</body>
<?php

if (isset($_POST['eliminar_habitacion'])) {
    $id_habitacion_a_eliminar = $_POST['id_habitacion'];

   $id_habitacion_seguro = mysqli_real_escape_string($link, $id_habitacion_a_eliminar);

    $eliminar = mysqli_query($link, "DELETE FROM rooms WHERE id = '$id_habitacion_seguro'"); // Corregimos la sintaxis de la consulta DELETE

    if ($eliminar) {
        echo "<script>alert('Habitación eliminada correctamente');</script>";
        echo "<script>window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Error al eliminar la habitación: " . mysqli_error($link) . "');</script>";
    }
}
?>
</html>
<br><br> <a href="../paneladminitrador.html" class="button">Volver al menu principal</a>