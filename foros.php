<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
$queryGetLibros = "SELECT * FROM tblposts";
$resQueryGetLibros = mysql_query($queryGetLibros, $conexionLocalhost) or die ("No se pudo ejecutar el query para obtener todos los usuarios");
$postsDetail = mysql_fetch_assoc($resQueryGetLibros);
$totalLibros = mysql_num_rows($resQueryGetLibros);
if(isset($_SESSION['userRol']) AND $_SESSION['userRol'] == 'admin' AND isset($_GET['postId'])){
  $queryDeleteVenta = "DELETE FROM tblposts Where id = ".$_GET['postId']."";
  $resQueryDeleteVenta = mysql_query($queryDeleteVenta, $conexionLocalhost) or die ("No se pudo ejecutar el query para obtener todos los usuarios");
  header("Location: foros.php?postDeletedByAdmin=true");
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
    <link href="css/hover.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>

<body>
<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
<?php
do{
    $queryGetUserDetails = "SELECT * FROM tblusuarios Where id = ".$postsDetail['idUsuario']."";
    $resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
    $userDetails = mysql_fetch_assoc($resQueryGetUserDetails);
?>

<div class="row justify-content-center mt-5 mb-5 animated flipInX">
  <div class="col-md-8">
    <div class="card flex-md-row mb-4 shadow-sm h-md-300">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Articulo</strong>
              <h3 class="mb-0">
                <?php echo $postsDetail['titulo'];?>
              </h3>
              <div class="mb-1 text-muted"><?php echo $userDetails['nombre'];?></div>
              <p class="card-text mb-auto"><?php echo $postsDetail['date_created'];?></p>
              <p>&nbsp;</p>
              <p>
              <?php echo substr($postsDetail['contenido'],0,155);?>. . .
              </p>
              
              <a href="articulo.php?postId=<?php echo $postsDetail['id'];?>&userId=<?php echo $userDetails['id'];?>">Continuar Leyendo</a>
              <?php if(isset($_SESSION['userRol']) AND $_SESSION['userRol'] == 'admin'){?>
                      <a class="btn btn-sm btn-outline-secondary" href="foros.php?postId=<?php echo $postsDetail['id'];?>">Eliminar</a>
                      <?php }?>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" alt="Thumbnail [200x230]" src="<?php echo $userDetails['img'];?>" style="width: 200px; height: 200px;">
    </div>
  </div>
</div>
<?php
}while($postsDetail = mysql_fetch_assoc($resQueryGetLibros));?>

</div>
<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>