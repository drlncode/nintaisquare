<?php
    session_start();
    require_once("../sources/controller/funciones.php");
    require_once("../sources/controller/pdo.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear | NintaiSquare</title>
    <link rel="stylesheet" href="../sources/assets/styles/create.css">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
</head>
<body>
    <div class="container">
        <?php
            require_once("../sources/templates/header/header-login.php");

            if (!isset($_GET["action"])) { ?>
                <div class="content">
                    <div class="content-title">
                        <h2>Que quieres hacer?</h2>
                    </div>
                    <div class="container-options">
                        <div class="option-content option-store">
                            <a href="index.php?action=store" class="option">
                                <h3 class="option-title"><i class="fa-solid fa-pen-to-square"></i>Registrar tienda.</h3>
                                <p class="option-caption">Aqui podrás registrar tu tienda, agregarle una descripción y los datos que le servirán a los usuarios para localizar tu tienda y sus productos.</p>
                            </a>
                        </div>
                        <div class="option-content option-product">
                            <a href="index.php?action=product" class="option">
                                <h3 class="option-title"><i class="fa-solid fa-pen-to-square"></i>Registrar producto.</h3>
                                <p class="option-caption">Aqui podrás registrarle productos a tus tiendas registradas, agregarle una descripción y los datos que le servirán a los usuarios para localizar tu tienda y adquirirlos.</p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } elseif (isset($_GET["action"]) && $_GET["action"] == "store") {
                require_once("../sources/templates/home/create/store.php");
            } elseif (isset($_GET["action"]) && $_GET["action"] == "product") {
                require_once("../sources/templates/home/create/product.php");
            } else {
                header("Location: https://nintaisquare.com/");
                return; 
            }

            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>