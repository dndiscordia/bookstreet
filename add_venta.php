<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");

$queryGetUserDetails = sprintf("SELECT * FROM tbllibros Where id = '%s'",
     mysql_real_escape_string(trim($_GET['libroId'])));
$resQueryGetUserDetails = mysql_query($queryGetUserDetails, $conexionLocalhost) or die("No se pudo ejecutar el query para obtener los datos del usuario");
$libroDetails = mysql_fetch_assoc($resQueryGetUserDetails);
if(isset($_POST['sent'])){
  if(!is_numeric($_POST['cantidad'])) { $error[] = "Cantidad Invalida"; }
  if(!isset($error)){
    $total = $_POST['cantidad']*$libroDetails['precio'];
    $queryUserRegister = sprintf("INSERT INTO tblventa (idUsuario, idLibro, cantidad, total, finalizada) 
    VALUES ('%d', '%d', '%d', '%d', 0)",
			$_SESSION['userId'],
			$libroDetails['id'],
			mysql_real_escape_string(trim($_POST["cantidad"])),
      $total
      );
      $resQueryUserRegister = mysql_query($queryUserRegister, $conexionLocalhost) or die("No se pudo guardar el usuario en la BD... Revisa tu codigo plomo.");
      if(mysql_num_rows($resQueryUserRegister)){
        $ventaData = mysql_fetch_assoc($resQueryUserRegister);
      }

    $queryCarritoRegister = sprintf("INSERT INTO tblcarritos (idUsuario, idVenta) 
      VALUES ('%d', '%d')",
        $ventaData['idUsuario'],
        $ventaData['idLibro']
      );
    $resQueryCarritoRegister = mysql_query($queryCarritoRegister, $conexionLocalhost) or die("No se pudo guardar el usuario en la BD... Revisa tu codigo plomo.");
    header("Location: carrito.php");
  }else{
    header("Location: add_venta.php?libroId=".$libroDetails['id']."");
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
<form action="add_venta.php?libroId=<?php echo $libroDetails['id'];?>" method="post">
<div class="row justify-content-center mt-5 mb-5">
  <div class="col-md-8">
    <div class="card flex-md-row mb-4 shadow-sm h-md-300">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Confirmar compra</strong>
              <h3 class="mb-0">
                <?php echo $libroDetails['titulo'];?>
              </h3>
              <div class="mb-1 text-muted"><?php echo $libroDetails['autor'];?></div>
              <p class="card-text mb-auto"><?php echo $libroDetails['descripcion'];?></p>
              <label for="cantidad">Cantidad: 
              <input type="number" name="cantidad" min=0 max=<?php echo $libroDetails['cantidad'];?>></input></label>
              <p>
              <strong class="d-inline-block mb-2 text-success">Precio: <?php echo $libroDetails['precio'];?></strong>    
              </p>
              <input type="submit" name="sent" value="Enviar al carrito"></input>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" alt="Thumbnail [200x230]" src="<?php echo $libroDetails['img'];?>" style="width: 200px; height: 300px;">
    </div>
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