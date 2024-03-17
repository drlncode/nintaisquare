<?php
    session_start();
    require_once("../sources/controller/funciones.php");
    require_once("../sources/controller/pdo.php");
    noset();

    function title_explore() {
        if (isset($_GET["action"]) && $_GET["action"] == "stores") {
            return "Explorar - Tiendas | NintaiSquare";
        } elseif (isset($_GET["action"]) && $_GET["action"] == "products") {
            return "Explorar - Productos | NintaiSquare";
        } else {
            return "Explorar | NintaiSquare";
        }
    }

    if (isset($_GET["refresh-stores"])) {
        header("Location: ../explore/?action=stores");
        exit;
    }

    if (isset($_GET["store-category"]) && isset($_GET["order-by"])) {
        if ($_GET["order-by"] == "ASC") {
            $query = $pdo -> prepare("SELECT * FROM val_stores WHERE store_category = :c ORDER BY store_id ASC;");
            $query -> execute(array(
                ':c' => htmlentities($_GET["store-category"])
            ));
        } elseif ($_GET["order-by"] == "DESC") {
            $query = $pdo -> prepare("SELECT * FROM val_stores WHERE store_category = :c ORDER BY store_id DESC;");
            $query -> execute(array(
                ':c' => htmlentities($_GET["store-category"])
            ));
        } else {
            header("Location: ../explore/?action=stores");
            exit;
        }
    } else {
        $query = $pdo -> query("SELECT * FROM val_stores ORDER BY Rand();");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title_explore(); ?></title>
    <link rel="stylesheet" href="../sources/assets/styles/explore.css">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
</head>
<body>
    <div class="container">
        <?php
            require_once("../sources/templates/header/header-login.php");

            if (!isset($_GET["action"])) { ?>
                <div class="container-content">
                    <div class="content">
                        <div class="content-h2">
                            <h2>Qué quieres ver?</h2>
                        </div>
                        <div class="container-options">
                            <div class="option-content option-store">
                                <a href="?action=stores" class="option">
                                    <h3 class="option-title"><i class="fa-solid fa-eye"></i></i></i>Ver tiendas.</h3>
                                    <p class="option-caption">Aqui podrás descubrir las diferentes tiendas ordenadas por orden de creación o categoría junto a sus productos.</p>
                                </a>
                            </div>
                            <div class="option-content option-product">
                                <a href="?action=products" class="option">
                                    <h3 class="option-title"><i class="fa-solid fa-eye"></i></i></i>Ver productos.</h3>
                                    <p class="option-caption">Aqui podrás descubrir los productos que te ofrecen las diferentes tiendas ordenados por categoría.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } elseif (isset($_GET["action"]) && $_GET["action"] == "stores") {
                require_once("../sources/templates/home/explore/stores.php");
            } elseif (isset($_GET["action"]) && $_GET["action"] == "products") {
                require_once("../sources/templates/home/explore/products.php");
            } else {
                header("Location: https://nintaisquare.com/");
                return; 
            }

            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>