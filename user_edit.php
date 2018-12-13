<?php
if(!isset($_SESSION)){
    session_start();
    if(!isset($_SESSION["userEmail"])){
		header("Location: login.php?invalidAccess=true");
	}
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");

$queryGetUserDetails = "SELECT * FROM tblusuarios Where id = ".$_SESSION['userId']."";
$resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
$userDetails = mysql_fetch_assoc($resQueryGetUserDetails);

if(isset($_POST['sent'])){
    foreach($_POST as $datosUsuario => $valor){
		  if($valor == "") { $error[] = "Error en el campo $datosUsuario"; }	
    }
    if(!isset($error)){
      $queryUserUpdate = sprintf("UPDATE tblusuarios SET nombre = '%s', password = '%s', telefono = '%s', img  = '%s' Where id = '%d'",
      mysql_real_escape_string(trim($_POST['nombre'])),
      convert_uuencode(mysql_real_escape_string(trim($_POST["password"]))),
			mysql_real_escape_string(trim($_POST["telefono"])),
			mysql_real_escape_string(trim($_POST["imagen"])),
			mysql_real_escape_string(trim($_POST["id"]))
      );
      $resQueryUserUpdate = mysql_query($queryUserUpdate, $conexionLocalhost) or die("No se pudo guardar el usuario en la BD.");

      header("Location: index.php?editadoExitoso=true");
    }else{
      header("Location: user_edit.php?error=true");
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bookstreet - Libreria Electronica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
</head>

<body>
<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
<form action="user_edit.php" method="post">
<div class="mt-5 row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 blog-main">
            <h4 class="mb-1 light-text-color">Nombre de Usuario:</h4>
            <input class="mb-4" type="text" name="nombre" value="<?php echo $userDetails['nombre']; ?>"/>
            <h4 class="mb-1 light-text-color">Correo Electronico:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['email'];?></h4>
            <h4 class="mb-1 light-text-color">Telefono:</h4>
            <input class="mb-4" type="text" name="telefono" value="<?php echo $userDetails['telefono']; ?>"/>
            <h4 class="mb-1 light-text-color">Imagen (URL):</h4>
            <input class="mb-4" type="text" name="imagen" value="<?php echo $userDetails['img']; ?>"/>
            <h4 class="mb-1 light-text-color">Contraseña:</h4>
            <input class="mb-4" type="text" name="password"/>
            <h4 class="mb-1 light-text-color">Tipo de Usuario:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['rol'];?></h4>
            <h4 class="mb-1 light-text-color">Fecha de Registro:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['date_created'];?></h4>
              <input type="hidden" name="id" value="<?php echo $userDetails['id']; ?>">
        </div>
    </div>
    <div class="mt-2 mb-4 row">
          <div class="col-10 d-flex justify-content-end align-items-center">
          <input type="submit" value="Actualizar usuario" name="sent" />
          </div>
    </div>
</form>
</div>
<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>