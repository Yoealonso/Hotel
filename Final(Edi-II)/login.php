<?php


session_start();

include_once("C:/xampp/htdocs/Final(Edi-II)/Conexion/conexion.php");

if (isset($_POST["enviar"])) {

    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $typ = $_POST["typ"];

    $sql = "SELECT id, email, pass, type FROM users WHERE email = ? AND pass = ? AND type = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sss", $email, $pass, $typ);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"]; 
        $_SESSION["user_email"] = $row["email"]; 
        $_SESSION["user_type"] = $row["type"]; 

        if ($row["type"] == "Cliente") {
            header("Location: panelcliente.html");
            exit();
        } elseif ($row["type"] == "Administrador") {
            header("Location: paneladminitrador.html");
            exit();
      
    }

    }

    $stmt->close();
    $link->close();
}

?>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Reservas de hotel</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <script src='main.js'></script>
    
</head>
<body>
   <div class="formulario">
 <form method="POST" class="login">

<h2>Bienvenido</h2>
<label>Email:</label>		 	
<input type="text" name="email" class="l"><br><br>
<label>Contraseña:</label>		 	
<input type="password" name="pass" class="l"><br><br>
<label>Tipo:</label>		 	
<select name="typ">
    <option></option>
    <option>Administrador</option>
    <option>Cliente</option>
</select>

<div class="links">
<input type="submit" name="enviar" value="Enviar"><br><br>
<p>¿No estas registrado?
Registrate<a href="Create/cargarcliente.php">acá</a></p>
 <a href="index.html">Volver</a>
 </form><br>



 </div>
</body>