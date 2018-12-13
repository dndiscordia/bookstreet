<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
if(!isset($_SESSION['userId'])){
  header("Location: login.php?userLogin=false");
}
$queryGetLibros = "SELECT * FROM tblventa Where idUsuario = ".$_SESSION['userId']."";
$resQueryGetLibros = mysql_query($queryGetLibros, $conexionLocalhost) or die ("Sin Resultados");
$ventaDetail = mysql_fetch_assoc($resQueryGetLibros);

if(isset($_POST['sent'])){
    $queryGetVentas = "SELECT * FROM tblventa Where id = ".$_GET['ventaId']."";
    $resQueryGetVentas = mysql_query($queryGetVentas, $conexionLocalhost) or die ("Sin Resultados");
    $estaVentaDetail = mysql_fetch_assoc($resQueryGetVentas);

    $queryGetLibroDetails = "SELECT * FROM tbllibros Where id = ".$estaVentaDetail['idLibro']."";
    $resQueryGetLibroDetails = mysql_query($queryGetLibroDetails, $conexionLocalhost) or die("Sin Resultados");
    $libroDetalles = mysql_fetch_assoc($resQueryGetLibroDetails);

    $nuevaCantidad = $libroDetalles['cantidad'] - $estaVentaDetail['cantidad'];

    $queryGetVenta = sprintf("UPDATE tblventa SET finalizada = 1 Where id = '%d'",
      mysql_real_escape_string(trim($estaVentaDetail['id'])));
    $resQueryGetVenta = mysql_query($queryGetVenta, $conexionLocalhost) or die("No se pudo guardar el usuario en la BD.");
    
    $queryLibroUpdate = sprintf("UPDATE tbllibros SET cantidad = $nuevaCantidad Where id = '%d'",
      mysql_real_escape_string(trim($libroDetalles['id'])));
    $resQueryLibroUpdate = mysql_query($queryLibroUpdate, $conexionLocalhost) or die("No se pudo guardar el usuario en la BD.");
    header("Location: carrito.php?compraExitosa=true");
}
if(isset($_POST['kill'])){
    $queryDeleteVenta = "DELETE FROM tblventa Where id = ".$_GET['ventaId']."";
    $resQueryDeleteVenta = mysql_query($queryDeleteVenta, $conexionLocalhost) or die ("Sin Resultados");
    header("Location: carrito.php?compraCancelada=true");
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
<?php
do{
    $queryGetUserDetails = "SELECT * FROM tbllibros Where id = ".$ventaDetail['idLibro']."";
    $resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or die("Sin Resultados");
    $libroDetails = mysql_fetch_assoc($resQueryGetUserDetails);
    if(!$ventaDetail['finalizada']){
?>
<form action="carrito.php?ventaId=<?php echo $ventaDetail['id'];?>" method="post">
<div class="row justify-content-center mt-5 mb-5">
  <div class="col-md-8">
    <div class="card flex-md-row mb-4 shadow-sm h-md-300">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Finalizar compra</strong>
              <h3 class="mb-0">
                <?php echo $libroDetails['titulo'];?>
              </h3>
              <div class="mb-1 text-muted"><?php echo $libroDetails['autor'];?></div>
              <p class="card-text mb-auto"><?php echo $libroDetails['descripcion'];?></p>
              <p>
              <strong class="d-inline-block mb-2 text-success">Cantidad: <?php echo $ventaDetail['cantidad'];?></strong>    
              </p>
              <p>
              <strong class="d-inline-block mb-2 text-success">Total: <?php echo $ventaDetail['total'];;?></strong>    
              </p>
              <input type="submit" name="sent" value="Finalizar compra"></input>
              <p> </p>
              <input type="submit" name="kill" value="Cancelar compra"></input>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" alt="Thumbnail [200x230]" src="<?php echo $libroDetails['img'];?>" style="width: 200px; height: 300px;">
    </div>
  </div>
</div>
</form>
<?php
}}while($ventaDetail = mysql_fetch_assoc($resQueryGetLibros));?>
</div>
<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>