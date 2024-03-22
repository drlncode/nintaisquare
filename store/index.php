<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    noset();

    if (!isset($_GET["store_id"]) || isset($_GET["store_id"]) && empty($_GET["store_id"])) {
        header("Location: https://nintaisquare.com/explore/");
        exit;
    } else {
        $query = $pdo -> prepare("SELECT * FROM val_stores WHERE store_id = :id");
        $query -> execute(array(
            ':id' => $_GET["store_id"]
        ));
        $store = $query -> fetch(PDO::FETCH_ASSOC);

        if ($store === false) {
            header("Location: https://nintaisquare.com/explore/");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $store["store_name"]; ?> | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/store.css">
    <link rel="stylesheet" href="../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="shortcut icon" href="../sources/assets/img/favicon.png" type="image/x-icon">
</head>
<body>
    <?php
        require_once("../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <?php
            require_once("../sources/templates/header/header-login.php");
        ?>
        <div class="store-content">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-shop"></i>Tienda</h2>
            </div>
            <div class="store">
                <div class="content-1">
                    <div class="store-img">
                        <img class="img" src="data:image/png;base64,<?= $store["store_img"]; ?>" title="<?= $store["store_name"]; ?>">
                    </div>
                    <div class="details">
                        <div class="name-category">
                            <h3 class="name"><i class="fa-solid fa-pen-to-square"></i><?= $store["store_name"]; ?></h3>
                            <span class="category"><?= prettyCategory($store["store_category"]); ?></span>
                        </div>
                        <div class="description">
                            <span class="description-text"><i class="fa-solid fa-comment"></i><?= $store["store_desc"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="content-2">
                    <div class="store-data">
                        <div class="title-data">
                            <h4 class="title title-h4"><i class="fa-solid fa-circle-info"></i>Ponte en contacto con esta tienda</h4>
                        </div>
                        <div class="phone-email">
                            <div class="phone">
                                <span class="text-plane phone-text"><i class="fa-solid fa-phone"></i><?= $store["store_tel"] ?></span>
                            </div>
                            <?php 
                                if (!empty($store["store_email"])) { ?>
                                    <div class="email">
                                        <span class="text-plane email-text"><i class="fa-solid fa-envelope"></i><?= $store["store_email"] ?></span>
                                    </div>
                                <?php }
                            ?>
                        </div>
                        <div class="socials-container">
                            <?php
                                if (!empty($store["store_social_ig"]) || !empty($store["store_social_tw"]) || !empty($store["store_social_fc"])) { ?>
                                    <div class="title-socials">
                                        <h4 class="title title-h4"><i class="fa-solid fa-heart"></i>También puedes encontrar esta tienda en</h4>
                                    </div>
                                    <div class="socials-links">
                                        <?php 
                                            if (!empty($store["store_social_ig"])) { ?>
                                                <div class="links">
                                                    <a href="<?= $store["store_social_ig"] ?>" class="ig-link" target="_blank"><i class="fa-brands fa-instagram"></i>Instagram</a>
                                                </div>
                                            <?php }
                                            if (!empty($store["store_social_tw"])) { ?>
                                                <div class="links">
                                                    <a href="<?= $store["store_social_tw"] ?>" class="tw-link" target="_blank"><i class="fa-brands fa-x-twitter"></i>Twitter</a>
                                                </div>
                                            <?php }
                                            if (!empty($store["store_social_fc"])) { ?>
                                                <div class="links">
                                                    <a href="<?= $store["store_social_fc"] ?>" class="fc-link" target="_blank"><i class="fa-brands fa-facebook"></i>Facebook</a>
                                                </div>
                                            <?php }
                                        ?>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="store-products">
                <div class="title">
                    <h3 class="sp-title"><i class="fa-solid fa-cart-shopping"></i>Productos</h3>
                </div>
                <div class="products">
                    <?php
                        $query = $pdo -> prepare("SELECT * FROM val_products WHERE store_id = :id LIMIT 4");
                        $query -> execute(array(
                            ':id' => $store["store_id"]
                        ));
                        if ($query -> rowCount() < 1) {
                            echo ("<span class='empty'><i class='fa-solid fa-xmark'></i>Esta tienda no tiene productos actualmente.</span>");
                        } else { ?>
                            <?php 
                            if ($query -> rowCount() >= 4) { ?>
                                <div class="see-all">
                                    <a href="https://nintaisquare.com/search/result/?all-products=<?= $store["store_id"] ?>" class="btn" target="_blank">Ver todo<i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            <?php }

                            while ($product = $query -> fetch(PDO::FETCH_ASSOC)) { ?>
                                <a href="">
                                    <div class="product">
                                        <div class="product-content-1">
                                            <div class="img-product">
                                                <img src="data:image/png;base64,<?= $product["product_img"] ?>" title="<?= $product["product_name"] ?>"/>
                                            </div>
                                            <div class="title-category-product">
                                                <div class="title-product">
                                                    <span class="p-name"><b><?= $product["product_name"] ?></b></span>
                                                </div>
                                                <div class="price-product">
                                                    <span class="price"><b><?= prettyPrice($product["product_price"]); ?></b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content-2">
                                            <div class="desc-product">
                                                <span class="desc"><?= $product["product_desc"] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>