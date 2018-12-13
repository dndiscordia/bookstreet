<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
if(isset($_GET['libroSearch'])){
    //Obtenemos todos los usuarios
    $search = "%".mysql_real_escape_string(trim($_GET['libroSearch']))."%";
    $queryGetUsers = "SELECT * FROM tbllibros WHERE titulo LIKE '$search' OR autor LIKE '$search'";
    $resQueryGetUser = mysql_query($queryGetUsers, $conexionLocalhost) or die ("No se pudo ejecutar el query para obtener todos los usuarios");
    $libroDetail = mysql_fetch_assoc($resQueryGetUser);
    //Contamos el total de suarios encontrados
    $totalLibros = mysql_num_rows($resQueryGetUser);
    }else{
        header("Location: search.php?invalidSearch=true");
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
</head>

<body>
<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
    <div class="container">
        <div class="row">
            <?php
            if($totalLibros!=0){
            do{
            ?>
            <div class="col-md-4 hvr-grow">
              <div class="card mb-4 mt-4 bg-light shadow-sm">
                <img class="card-img-top mt-1 align-self-center" alt="Thumbnail [100%x225]" style="height: 225px; width: 50%; display: block;" src=<?php echo $libroDetail['img'];?> data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text"><strong class="d-inline-block mb-2 text-primary"><?php echo $libroDetail['titulo'];?></strong></p>
                  <p class="card-text"><?php echo $libroDetail['descripcion'];?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">
                      <a href="libro.php?libroId=<?php echo $libroDetail['id'];?>">Ver</a>
                      </button>
                      <a class="btn btn-sm btn-outline-secondary" href="add_venta.php?libroId=<?php echo $libroDetail['id'];?>">Comprar</a>
                    </div>
                    <small class="text-muted"><?php echo $libroDetail['tipoProducto'];?></small>
                  </div>
                </div>
              </div>
            </div>
            <?php
            }while($libroDetail = mysql_fetch_assoc($resQueryGetUser));
        }else{
            
        }
            ?>

        </div>
    </div>
</div>
<!-- Footer -->

<?php if($totalLibros!=0){
include("includes/footer.php");
} ?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>