<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
if(!isset($_GET['userId'])){
    header("Location: index.php?unkwownRoute=0");
}
$queryGetPostDetails = "SELECT * FROM tblusuarios Where id = ".$_GET['userId']."";
$resQueryGetPostDetails = mysql_query($queryGetPostDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
$userDetails = mysql_fetch_assoc($resQueryGetPostDetails);
if(isset($_SESSION['userRol']) AND $_SESSION['userRol'] == 'admin' AND isset($_GET['userId']) AND isset($_GET['deleteUser'])){
    $queryDeleteVenta = "DELETE FROM tblusuarios Where id = ".$_GET['userId']."";
    $resQueryDeleteVenta = mysql_query($queryDeleteVenta, $conexionLocalhost) or die ("No se pudo ejecutar el query para obtener todos los usuarios");
    header("Location: index.php?userDeletedByAdmin=true");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>

<body>
<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
    <div class="mt-5 row">
        <div class="col-md-1">
        </div>
        <aside class="col-md-3 blog-sidebar bg-light d-flex justify-content-center animated fadeInLeft">
            <?php
            if(!isset($userDetails["img"])){
            echo
            "<img class=\"card-img-right flex-auto d-none d-lg-block\" 
            data-src=\"holder.js/200x250?theme=thumb\" 
            alt=\"Sin Imagen [200x250]\" 
            style=\"width: 200px; height: 250px;\" 
            
            data-holder-rendered=\"true\">";
            }else{
            echo
            "<img class=\"card-img-right flex-auto d-none d-lg-block mt-4\" 
            data-src=\"holder.js/200x250?theme=thumb\" 
            alt=\"Sin Imagen [200x250]\" 
            style=\"width: 200px; height: 200px;\" 
            src=".$userDetails['img']." 
            data-holder-rendered=\"true\">";
            }
            ?>
        </aside>
        <div class="col-md-6 blog-main animated fadeInRight">
            <h4 class="mb-1 light-text-color">Nombre de Usuario:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['nombre'];?></h4>
            <h4 class="mb-1 light-text-color">Correo Electronico:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['email'];?></h4>
            <h4 class="mb-1 light-text-color">Telefono:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['telefono'];?></h4>
            <h4 class="mb-1 light-text-color">Rol del Usuario:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['rol'];?></h4>
            <h4 class="mb-1 light-text-color">Fecha de Registro:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $userDetails['date_created'];?></h4>
        </div>
    </div>
    <?php if(isset($_SESSION['userRol']) AND $_SESSION['userRol'] == 'admin'){?>
    <div class="mt-2 mb-4 row">
          <div class="col-10 d-flex justify-content-end align-items-center">
          
                      <a class="btn btn-sm btn-outline-secondary" href="view_perfil.php?userId=<?php echo $userDetails['id'];?>&deleteUser=true">Eliminar</a>
                      
          </div>
    </div>
    <?php }?>

</div>
<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>