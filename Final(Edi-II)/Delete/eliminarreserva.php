<?php
session_start();
include_once("../Conexion/conexion.php");

if (!isset($link) || $link->connect_error) {
    die("Error de conexión a la base de datos: " . $link->connect_error);
}

//----------------------------------------------------------- DELETE -----------------------------------------------------------

if (isset($_POST['eliminar_reserva'])) { 
    $id_reserva_a_eliminar = $_POST['id_reserva'];

    // Validación y saneamiento del ID
    $id_reserva_seguro = mysqli_real_escape_string($link, $id_reserva_a_eliminar);

    // Usar consultas preparadas es más seguro
    $stmt = mysqli_prepare($link, "DELETE FROM reserves WHERE id = ?"); // Asegúrate que la tabla es 'reserves'
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_reserva_seguro);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Reserva eliminada correctamente');</script>";
            echo "<script>window.location.href = window.location.href;</script>"; // Recargar la página
        } else {
            echo "<script>alert('Error al eliminar la reserva: " . htmlspecialchars(mysqli_stmt_error($stmt)) . "');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error al preparar la consulta de eliminación: " . htmlspecialchars(mysqli_error($link)) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reserva</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../style.css">
    </head>
<body>

    <div class="container"> <h1>Eliminar Reserva</h1>

        <form action="" method="POST" onsubmit="return confirmarEliminacionReserva();">
            <label for="reserva">Seleccione la reserva que desea eliminar:</label>
            <select id="reserva" name="id_reserva" class="select" required>
                <option value="">-- Seleccione una reserva --</option>
                <?php
                
                $query_reservas = "
                    SELECT
                        R.id AS reserva_id,
                        U.name AS nombre_usuario,
                        U.lastName AS apellido_usuario,
                        RO.number AS numero_habitacion,
                        R.fechainicio,
                        R.fechafinal
                    FROM
                        reserves AS R
                    INNER JOIN
                        users AS U ON R.iduser = U.id
                    INNER JOIN
                        rooms AS RO ON R.idroom = RO.id
                    ORDER BY
                        R.fechainicio DESC";

                $result_reservas = mysqli_query($link, $query_reservas);

                if ($result_reservas) {
                    if (mysqli_num_rows($result_reservas) > 0) {
                        while ($fila = mysqli_fetch_assoc($result_reservas)) {
                            echo "<option value='" . htmlspecialchars($fila['reserva_id']) . "'>";
                            echo "ID: " . htmlspecialchars($fila['reserva_id']);
                            echo " | Usuario: " . htmlspecialchars($fila['nombre_usuario'] . " " . $fila['apellido_usuario']);
                            echo " | Habitación: " . htmlspecialchars($fila['numero_habitacion']);
                            echo " | Fechas: " . htmlspecialchars($fila['fechainicio']) . " a " . htmlspecialchars($fila['fechafinal']);
                            echo "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay reservas para eliminar</option>";
                    }
                } else {
                    echo "<option value=''>Error al cargar reservas: " . htmlspecialchars(mysqli_error($link)) . "</option>";
                }
                ?>
            </select>
            <br><br>

            <input type="submit" name="eliminar_reserva" value="Eliminar Reserva" class="button button-delete">
        </form>

        <div class="links">
            <a href="../Read/mostrarreserva.php" class="button">Volver a Mis Reservas</a>
            <a href="../panelcliente.html" class="button">Volver al Menú Principal</a>
        </div>
    </div>

    <script>
    function confirmarEliminacionReserva() {
        var reservaSelect = document.getElementById("reserva");
        var idReserva = reservaSelect.value;
        var textoReserva = reservaSelect.options[reservaSelect.selectedIndex].text; // Obtener el texto completo de la opción

        if (!idReserva) {
            alert("Por favor, seleccione una reserva para eliminar.");
            return false; // Evita el envío del formulario
        }

        var confirmacion = confirm("¿Está seguro que desea eliminar la siguiente reserva?\n\n" + textoReserva + "\n\n¡Esta acción no se puede deshacer!");
         window.location.href="../Read/mostrarreserva.php";
        return confirmacion; // Retorna true si confirma, false si cancela
    }

    </script>

    <?php
    mysqli_close($link);
    ?>
</body>
</html>