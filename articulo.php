<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
$queryGetPostDetails = "SELECT * FROM tblposts Where id = ".$_GET['postId']."";
$resQueryGetPostDetails = mysql_query($queryGetPostDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
$postDetails = mysql_fetch_assoc($resQueryGetPostDetails);

$queryGetUserDetails = "SELECT * FROM tblusuarios Where id = ".$_GET['userId']."";
$resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
$userDetails = mysql_fetch_assoc($resQueryGetUserDetails);

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
<div class="blog-post blog-fix">
            <h2 class="blog-post-title"><?php echo $postDetails['titulo'];?></h2>
            <p class="blog-post-meta"><?php echo $postDetails['date_created'];?> <a href="view_perfil.php?userId=<?php echo $userDetails['id'];?>"><?php echo $userDetails['nombre'];?></a></p>

            <p><?php echo $postDetails['contenido'];?></p>
          </div>    

</div>
<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>