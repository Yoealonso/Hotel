<?php
session_start();

include_once("C:/xampp/htdocs/Final(Edi-II)/Conexion/conexion.php");

if (!isset($link) || $link->connect_error) {
    die("Error de conexión a la base de datos: " . $link->connect_error);
}

if (!isset($_SESSION["user_id"])) {
    echo '<script type="text/javascript">
            alert("No has iniciado sesión o tu sesión ha expirado.");
            window.location.href="login.html"; // Redirige a la página de login
          </script>';
    exit();
}

$current_user_id = $_SESSION["user_id"];

$query = "SELECT 
            r.fechainicio, 
            r.fechafinal, 
            ro.number AS room_number,
            ro.type AS room_type 
          FROM 
            reserves r
          JOIN 
            rooms ro ON r.idroom = ro.id
          WHERE 
            r.iduser = ?";

$stmt = mysqli_prepare($link, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $current_user_id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    echo "<!DOCTYPE html>";
    echo "<html lang='es'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "     <link rel='stylesheet' type='text/css' media='screen' href='../style.css'>";
    echo "    <title>Mis Reservas</title>";
    echo "    <style>";
    echo "        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }";
    echo "        h1 { color:#5C4033; }";
    echo "        table { width: 80%; border-collapse: collapse; margin-top: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }";
    echo "        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }";
    echo "        th { background-color:  #A0522D; color: white; }";
    echo "        tr:nth-child(even) { background-color: #f2f2f2; }";
    echo "        .no-reservations { text-align: center; margin-top: 20px; color: #555; }";
    echo "        .links { margin-top: 30px; }";
    echo "        .links a { display: inline-block; margin-right: 15px; padding: 10px 15px; background-color: #f2f2f2; color: white; text-decoration: none; border-radius: 5px;}";
    echo "        .links a:hover { background-color: #aab5b5ff;}";
    echo "    </style>";
    echo "</head>";
    echo "<body>";

    echo "<h1>Mis Reservas</h1>";

    echo "<table>";
    echo "<tr>";
    echo "   <th><center>Habitación</center></th>";
    echo "   <th><center>Tipo de habitación</center></th>";
    echo "   <th><center>Fecha de Inicio</center></th>";
    echo "   <th><center>Fecha Final</center></th>";
    echo "</tr>";

    if (mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "   <td><center>" . htmlspecialchars($fila['room_number']) . "</center></td>"; // Acceder por nombre de columna
            echo "   <td><center>" . htmlspecialchars($fila['room_type']) . "</center></td>";
            echo "   <td><center>" . htmlspecialchars($fila['fechainicio']) . "</center></td>";
            echo "   <td><center>" . htmlspecialchars($fila['fechafinal']) . "</center></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='no-reservations'>No tienes reservas realizadas.</td></tr>";
    }

    echo "</table>";

    echo "<div class='links'>";
    echo "<a href='../Create/cargarreservas.php'>Cargar otra reserva</a>"; // Cambié el enlace para cargar reservas
     echo "<a href='../Delete/eliminarreserva.php'>Eliminar reserva</a>"; // Cambié el enlace para cargar reservas
    echo "<a href='../panelcliente.html'>Volver al menú principal</a>";
    echo "</div>";

    echo "</body>";
    echo "</html>";

    
    mysqli_stmt_close($stmt);

} else {
    
    echo '<script type="text/javascript">
            alert("Error al preparar la consulta: ' . htmlspecialchars(mysqli_error($link)) . '");
          </script>';
}

mysqli_close($link);
?>
