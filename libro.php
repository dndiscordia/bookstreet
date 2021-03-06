<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
$queryGetUserDetails = "SELECT * FROM tbllibros Where id = ".$_GET['libroId']."";
$resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
$libroDetails = mysql_fetch_assoc($resQueryGetUserDetails);
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
<div class="mt-5 row">
        <div class="col-md-1">
        </div>
        <aside class="col-md-3 blog-sidebar bg-light d-flex justify-content-center">
            <img class="card-img-right flex-auto d-none d-lg-block" 
            src="<?php echo $libroDetails['img'];?>" 
            alt="Sin Imagen [200x250]" 
            style="width: 200px; height: 250px;" 
            >
          <?php;?>
        </aside>
        <div class="col-md-6 blog-main">
            <h4 class="mb-1 light-text-color">Titulo del Libro:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['titulo'];?></h4>
            <h4 class="mb-1 light-text-color">Autor:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['autor'];?></h4>
            <h4 class="mb-1 light-text-color">Fecha:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['fechaPublicacion'];?></h4>
            <h4 class="mb-1 light-text-color">Editorial:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['editorial'];?></h4>
            <h4 class="mb-1 light-text-color">Descripcion:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['descripcion'];?></h4>
            <h4 class="mb-1 light-text-color">Tipo:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['tipoProducto'];?></h4>
            <h4 class="mb-1 light-text-color">Cantidad:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['cantidad'];?></h4>
            <h4 class="mb-1 light-text-color">Precio:</h4>
              <h4 class="mb-4 border-bottom font-casual"><?php echo $libroDetails['precio']."$";?></h4>  

        </div>
    </div>
    <div class="mt-2 mb-4 row">
          <div class="col-10 d-flex justify-content-end align-items-center">
            <a class="btn btn-sm btn-outline-secondary" href="add_venta.php?libroId=<?php echo $libroDetails['id'];?>">Comprar</a>
          </div>
    </div>
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