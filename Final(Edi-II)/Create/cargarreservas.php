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

?>
<!------------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css">
    <script src='main.js'></script>
    <title>Reservar Habitación</title>
</head>
<body>

    <h1>Realizar Nueva Reserva</h1>

    <form action="" method="POST"> <p>Seleccione la habitación para hacer la reserva:</p>
        <select name="id_habitacion_seleccionada" required> <option value="">-- Seleccione una habitación --</option>
            <?php
            $query_rooms = "SELECT id,type number FROM rooms ORDER BY number ASC";
            $result_rooms = mysqli_query($link, $query_rooms);

            if ($result_rooms) {
                while ($fila = mysqli_fetch_assoc($result_rooms)) {
                    echo "<option value='" . htmlspecialchars($fila['id']) . "'>" . htmlspecialchars($fila['number']) . "</option>";
                }
            } else {
                echo "<option value=''>Error al cargar habitaciones</option>";
               
            }
            ?>
        </select>
        <br><br>

        <label for="fechaInicio">Fecha de Inicio:</label><br>
        <input type="date" id="fechaInicio" name="fechaInicio" required><br><br>

        <label for="fechaFinal">Fecha Final:</label><br>
        <input type="date" id="fechaFinal" name="fechaFinal" required><br><br>

        <input type="submit" name="enviar" value="Confirmar Reserva">
        <a href="../panelcliente.html" class="button">Volver</a>
    </form>

</body>
</html>
<!------------------------------------------------------------------------------------------------------------------------------->

<?php
if (isset($_POST["enviar"])) {
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFinal = $_POST["fechaFinal"];
    $id_habitacion_seleccionada = $_POST["id_habitacion_seleccionada"];

    // Verificaciones de fecha y campos
    if (empty($fechaInicio) || empty($fechaFinal) || empty($id_habitacion_seleccionada)) {
        echo '<script type="text/javascript">alert("Todos los campos son obligatorios.");</script>';
        exit();
    }

    //----------------------------------------------------------- Confirmación y validación de fecha ----------------------------------------------------------- 
    $fechaInicioObj = new DateTime($fechaInicio);
    $fechaFinalObj = new DateTime($fechaFinal);
    $fechaActualObj = new DateTime('today'); 

       if ($fechaInicioObj < $fechaActualObj->setTime(0,0,0)) {
        echo '<script type="text/javascript">alert("La fecha que seleccionó es invalida, seleccione una fecha presente o futura.");</script>';
        exit();
    }

        if ($fechaFinalObj <= $fechaInicioObj) {
        echo '<script type="text/javascript">alert("Esta fecha es inferior a la fecha inicial, seleccione una fecha posterior.");</script>';
        exit();
    }

    //------------------------------------------------------------------------------------------------------------------

    $cadena = "INSERT INTO reserves(fechainicio, fechafinal, iduser, idroom) VALUES(?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $cadena);

    if ($stmt) {
                
        mysqli_stmt_bind_param($stmt, "ssii", $fechaInicio, $fechaFinal, $current_user_id, $id_habitacion_seleccionada);

                $consulta_exitosa = mysqli_stmt_execute($stmt);

        if ($consulta_exitosa) {
            echo '<script type="text/javascript">
                    alert("Éxito al cargar la reserva");
                    window.location.href="../Read/mostrarreserva.php";
                  </script>';
        } else {
                        echo '<script type="text/javascript">
                    alert("Error al cargar la reserva: ' . htmlspecialchars(mysqli_stmt_error($stmt)) . '");
                  </script>';
        }

                mysqli_stmt_close($stmt);

    } 
}
mysqli_close($link);
?>
