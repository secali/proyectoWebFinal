<?php
session_start();
$url_base="http://localhost:3000/";
if(!isset($_SESSION['usuario'])){
    header("location:".$url_base."login.php");
}else{
    
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $url_base;?>index.php">Inicio<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>modulos/empleados/index.php">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>modulos/puestos/index.php">Puestos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
  <main class="container">
