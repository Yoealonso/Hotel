
<?php 
include_once("C:/xampp/htdocs/Final(Edi-II)/Conexion/conexion.php");


if (isset($_POST["enviar"])) {
	$name = $_POST["name"];
    $lastName = $_POST["lastName"];
    $dni = $_POST["dni"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $typ = $_POST["typ"];
	
	
	$cadena = "INSERT INTO users(name, lastName, dni, telephone, email, pass, type) VALUES('$name', '$lastName', '$dni', '$telephone', '$email', '$pass', '$typ')";
	$consulta = mysqli_query($link,$cadena);
	

    if ($consulta)
	{	

		echo '<script type="text/javascript">
		 alert ("Exito al cargar el usuario");
		 window.location.href="login.php";
		</script>';
	
        }else{

		echo "<script> alert('error al cargar')></script>";
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
<h2>Complete los campos para registrar un nuevo usuario</h2>
<label>Nombre:</label>		 	
<input type="text" name="name" required><br><br>
<label>Apellido:</label>
<input type="text" name="lastName" required><br><br>
<label>DNI:</label>		 	
<input type="text" name="dni" required><br><br>
<label>Telefono:</label>		 	
<input type="text" name="telephone" required><br><br>
<label>Email:</label>		 	
<input type="text" name="email" required><br><br>
<label>Contraseña:</label>		 	
<input type="password" name="pass" required><br><br>
<label>Puede optar por un cliente o nuevo administrador:</label>		 	
<select name="typ" required>
    <option></option>
    <option name="typ">Administrador</option>
    <option name="typ">Cliente</option>
</select><br><br>

<input type="submit" name="enviar" value="Enviar">

<a href="../paneladminitrador.html" class="button">Volver</a>
 </form>

 