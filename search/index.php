<?php
    session_start();
    require_once("../sources/controller/funciones.php");
    require_once("../sources/controller/pdo.php");
    noset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../sources/assets/styles/search.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
</head>
<body>
    <?php
        require_once("../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <?php
            require_once("../sources/templates/header/header-login.php");
        ?>
        <div class="search-container">
            <div class="search-header">
                <h2 class="title"><i class="fa-solid fa-magnifying-glass"></i>Buscar</h2>
            </div>
            <div class="search-content">
                <div class="search-bar-container">
                    <form action="result/" method="get" class="search-bar-content">
                        <?php
                            if (isset($_GET["filter"]) && $_GET["filter"] == "str") { ?>
                                <input type="hidden" name="str">
                            <?php } elseif (isset($_GET["filter"]) && $_GET["filter"] == "pdt") { ?>
                                <input type="hidden" name="pdt">
                            <?php }
                        ?>
                        <div class="search-bar">
                            <input type="text" name="query" id="query" class="bar" placeholder="Buscar...">
                        </div>
                        <button type="submit" class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="added-filter">
                    <div class="filter-title">
                        <?php
                            if (isset($_GET["filter"]) && $_GET["filter"] == "str") { ?>
                                <h3 class="title"><i class="fa-solid fa-circle-check"></i>Solo se mostrarán resultados de tiendas. <a href="?restarted" class="reset">Restablecer<i class="fa-solid fa-delete-left"></i></a></h3>
                            <?php } elseif (isset($_GET["filter"]) && $_GET["filter"] == "pdt") { ?>
                                <h3 class="title"><i class="fa-solid fa-circle-check"></i>Solo se mostrarán resultados de productos. <a href="?restarted" class="reset">Restablecer<i class="fa-solid fa-delete-left"></i></a></h3>
                            <?php } else { ?>
                                <h3 class="title">¿Deseas buscar algo en específico?</h3>
                            <?php }
                        ?>
                    </div>
                    <div class="search-options">
                        <a href="../search/?filter=str">
                            <div class="option only-stores">
                                <?php
                                    if (isset($_GET["filter"]) && $_GET["filter"] == "str") { ?>
                                        <div class="check"><i class="fa-solid fa-check"></i></div>
                                    <?php }
                                ?>
                                <div class="option-title">
                                    <h4 class="title">Solo tiendas.</h4>
                                </div>
                                <div class="option-body">
                                    <span class="text-body">Al seleccionar esta opción los resultados que se le mostrarán serán solo coincidencias de tiendas.</span>
                                </div>
                            </div>
                        </a>
                        <a href="../search/?filter=pdt">
                            <div class="option only-products">
                                <?php
                                    if (isset($_GET["filter"]) && $_GET["filter"] == "pdt") { ?>
                                        <div class="check"><i class="fa-solid fa-check"></i></div>
                                    <?php }
                                ?>
                                <div class="option-title">
                                    <h4 class="title">Solo productos.</h4>
                                </div>
                                <div class="option-body">
                                    <span class="text-body">Al seleccionar esta opción los resultados que se le mostrarán serán solo coincidencias de productos.</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>