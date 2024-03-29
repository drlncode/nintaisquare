<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    noset();

    $query_val = $pdo -> prepare("SELECT * FROM val_stores WHERE user_id = :id;");
    $query_val -> execute(array(
        ':id' => $_SESSION["USER_AUTH"]["user_id"]
    ));

    $query_pen = $pdo -> prepare("SELECT * FROM pen_stores WHERE user_id = :id;");
    $query_pen -> execute(array(
        ':id' => $_SESSION["USER_AUTH"]["user_id"]
    ));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis tiendas | NintaiSquare</title>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../sources/assets/styles/user-stores.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require_once("../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <?php
            require_once("../sources/templates/header/header-login.php");

            if ($query_pen -> rowCount() >= 1) { ?>
                <div class="earrings">
                    <a href="?tabFor" class="tabFor-link">Tiendas pendientes<i class="fa-solid fa-angle-right"></i></a>
                </div>
                <?php
                    if (isset($_GET["tabFor"])) { ?>
                        <div class="tabFor">
                            <div class="content">
                                <div class="out">
                                    <a href="mystores.php"><i class="fa-regular fa-circle-xmark"></i></a>
                                </div>
                                <div class="content-header">
                                    <h3 class="title"><i class="fa-regular fa-clock"></i>Mis tiendas pendientes.</h3>
                                </div>
                                <div class="pen-stores">
                                    <?php
                                        $query = $pdo -> prepare("SELECT * FROM pen_stores WHERE user_id = :id;");
                                        $query -> execute(array(
                                            ':id' => $_SESSION["USER_AUTH"]["user_id"]
                                        ));

                                        while ($store = $query -> fetch(PDO::FETCH_ASSOC)) { ?>
                                            <div class="pen-store">
                                                <div class="pen-store-img">
                                                    <img src="data:img/png;base64,<?= $store["store_img"] ?>" alt="">
                                                </div>
                                                <div class="name-category">
                                                    <span class="name"><?= $store["store_name"] ?></span>
                                                    <span class="category"><?= prettyCategory($store["store_category"]); ?></span>
                                                </div>
                                            </div>
                                        <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                ?>
            <?php }
        ?>
        <div class="user-stores-container">
            <div class="user-stores-header">
                <h2 class="title"><i class="fa-solid fa-shop"></i>Mis tiendas</h2>
            </div>
            <div class="user-stores-content">
                <?php
                    if ($query_val -> rowCount() < 1) { ?>
                        <span class="no-stores"><i class="fa-solid fa-xmark"></i>No tienes tiendas registradas actualmente.</span>
                    <?php } else {
                        while ($store = $query_val -> fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="user-store">
                                <div class="store-category">
                                    <span class="category"><?= prettyCategory($store["store_category"]) ?></span>
                                </div>
                                <div class="store-img">
                                    <img src="data:img/png;base64,<?= $store["store_img"] ?>" Title="<?= $store["store_name"] ?>">
                                </div>
                                <div class="name-actions">
                                    <div class="store-name">
                                        <span class="name"><?= $store["store_name"] ?></span>
                                    </div>
                                    <div class="actions">
                                        <a href="https://nintaisquare.com/store/?store_id=<?= $store["store_id"] ?>" target="_blank" class="btn see-store">Detalles</a>
                                        <a href="delete/?dlt-str=<?= $store["store_id"] ?>" class="btn delete-store">Borrar</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                ?>
            </div>
        </div>
        <?php
            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>