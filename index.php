<?php
include("./plantillas/header.php");
include("./db.php");

// Obtener categorías únicas desde la base de datos
$consultaCategorias = $conexion->query("SELECT DISTINCT categoria FROM empleos");
$categorias = $consultaCategorias->fetchAll(PDO::FETCH_COLUMN);

// Filtrar por categoría si se ha seleccionado una
$filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$filtroCategoriaSQL = $filtroCategoria ? " WHERE categoria = '$filtroCategoria'" : '';

// Buscar por título si se ha enviado un término de búsqueda
$busquedaTitulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$filtroTituloSQL = $busquedaTitulo ? " AND titulo LIKE '%$busquedaTitulo%'" : '';

// Consultar empleos según los filtros
$consultaEmpleos = $conexion->query("SELECT * FROM empleos $filtroCategoriaSQL $filtroTituloSQL");
$empleos = $consultaEmpleos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Empleos Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <header>

    </header>

    <main class="container">
        <h1 class="mt-5">Lista de Empleos Disponibles</h1>

        <!-- Formulario de búsqueda y filtrado -->
        <form method="get">
            <div class="mb-3">
                <label for="categoria">Filtrar por Categoría:</label>
                <select name="categoria" id="categoria" class="form-select">
                    <option value="">Todas las Categorías</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?php echo $categoria; ?>" <?php echo ($filtroCategoria == $categoria) ? 'selected' : ''; ?>>
                            <?php echo $categoria; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="titulo">Buscar por Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $busquedaTitulo; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
        </form>

        <!-- Lista de empleos -->
        <?php if ($empleos) : ?>
            <div class="row mt-3">
                <?php foreach ($empleos as $empleo) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $empleo['titulo']; ?></h5>
                                <p class="card-text"><?php echo $empleo['descripcion']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>No se encontraron empleos.</p>
        <?php endif; ?>
    </main>

    <footer>

    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php include("./plantillas/footer.php"); ?>
