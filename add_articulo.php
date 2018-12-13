<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
if(!isset($_SESSION['userId'])){
    header("Location: index.php?userLoggedIn=false");
}
if(isset($_POST['sent'])){
    foreach($_POST as $datos => $valor){
		if($valor == "") {
            $error[] = "El campo $datos se encuentra vacio"; 
        }
    }
    if(!isset($_POST['error'])){
        $queryLibroRegister = sprintf("INSERT INTO tblposts(titulo, contenido, idUsuario) 
        VALUES ('%s', '%s', '%d')",
			mysql_real_escape_string(trim($_POST["titulo"])),
			mysql_real_escape_string(trim($_POST["texto"])),
            $_SESSION['userId']
        );
        $resQueryLibroRegister = mysql_query($queryLibroRegister, $conexionLocalhost) or die("No se pudo guardar el usuario en la BD... Revisa tu codigo plomo.");
        header("Location: publicar.php");
    }else{
        header("Location: add_articulo.php?error=true");
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
<form action="add_articulo.php" method="post" class="form-style-9">
<ul>
<li>
<input type="text" name="titulo" class="field-style field-full align-none" placeholder="Titulo o Asunto" required />
</li>
<li>
<textarea name="texto" class="field-style" placeholder="Mensaje"></textarea>
</li>
<li>
<input type="submit" name="sent" value="Publicar articulo" />
</li>
</ul>
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