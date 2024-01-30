
<?php include("plantillas/header.php");?>

<style>
	section {
		display: flex;
		width: 600px;
		height: 430px;
	}

	section img {
		width: 0;
		flex-grow: 1;
		object-fit: cover;
		opacity: 0.8;
		transition: width 0.5s ease, opacity 0.5s ease;
	}

	section img:hover {
		cursor: crosshair;
		width: 300px;
		opacity: 1;
		filter: contrast(120%);
	}
</style>

<br/>

<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Bienvenido al sistema</h1>
    <p class="col-md-8 fs-4"><?php echo $_SESSION['usuario'];?></p>
    <a name="" id="" class="btn btn-primary" href="modulos\usuarios\index.php" role="button">Usuarios</a>
  </div>

</div>
<section>
<img src="assets\arquitectura-casa-moderna-wallpaper-preview.jpg">
  <img src="assets\HD-wallpaper-mansion-architecture-houses-luxury.jpg">
  <img src="assets\346484.jpg">
  <img src="assets\Family_house_front_yard_garage_2017_4K_HD_Wallpaper_3840x2400.jpg">
  <img src="assets\60032.jpg">
  
</section>  

<?php include("plantillas/footer.php");?>
