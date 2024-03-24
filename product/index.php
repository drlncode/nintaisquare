<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    noset();

    if (!isset($_GET["product_id"]) || isset($_GET["product_id"]) && empty($_GET["product_id"])) {
        header("Location: https://nintaisquare.com/explore/");
        exit;
    } else {
        $query = $pdo -> prepare("SELECT * FROM val_products WHERE product_id = :id");
        $query -> execute(array(
            ':id' => $_GET["product_id"]
        ));
        $product = $query -> fetch(PDO::FETCH_ASSOC);

        if ($product === false) {
            header("Location: https://nintaisquare.com/explore/");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product["product_name"]; ?> | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/product.css">
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
        <div class="product-content">
            <div class="general-title">
                <h2 class="title"><i class="fa-solid fa-cart-shopping"></i>Producto</h2>
            </div>
            <div class="content">
                <div class="product">
                    <div class="top-product">
                        <div class="img-product">
                            <img src="data:image/png;base64,<?= $product["product_img"] ?>" title="<?= $product["product_name"] ?>">
                        </div>
                        <div class="details-product">
                            <div class="name-category">
                                <h3 class="product-name"><i class="fa-solid fa-pen-to-square"></i><?= $product["product_name"] ?></h3>
                                <span class="product-category"><?= prettyCategory($product["product_category"]); ?></span>
                            </div>
                            <span class="product-price"><?= prettyPrice($product["product_price"]) ?></span>
                            <div class="store">
                                <?php
                                    $query = $pdo -> prepare("SELECT store_id, store_name FROM val_stores WHERE store_id = :id");
                                    $query -> execute(array(
                                        ':id' => $product["store_id"]
                                    ));
                                    $store_data = $query -> fetch(PDO::FETCH_ASSOC);
                                ?>
                                <span class="store-name"><i class="fa-solid fa-shop"></i><?= $store_data["store_name"] ?></span>
                                <a href="https://nintaisquare.com/store/?store_id=<?= $store_data["store_id"] ?>" class="go-store">Visitar<i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="buttom-product">
                        <div class="product-desc">
                            <span class="desc"><i class="fa-solid fa-comment"></i><?= $product["product_desc"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="recommendations">
                    <div class="recomm-title">
                        <h3 class="title"><i class="fa-solid fa-heart"></i>Tambien te puede interesar</h3>
                    </div>
                    <div class="some-products">
                        <span class="no-recommendation">Sin recomendaciones.</span>
                        <?php
                            $query = $pdo -> prepare("SELECT product_id, product_name, product_price, product_img FROM val_products WHERE product_category = :ct LIMIT 5;");
                            $query -> execute(array(
                                ':ct' => $product["product_category"]
                            ));
                            
                            while ($some_product = $query -> fetch(PDO::FETCH_ASSOC)) {
                                if ($some_product["product_id"] == $_GET["product_id"]) {
                                    continue;
                                } ?>
                                
                                <a href="https://nintaisquare.com/product/?product_id=<?= $some_product["product_id"]; ?>" class="some-product-link">
                                    <div class="some-product">
                                        <div class="some-product-img">
                                            <img src="data:image/png;base64,<?= $some_product["product_img"] ?>" alt="">
                                        </div>
                                        <div class="some-product-name-price">
                                            <span class="some-product-name"><b><?= $some_product["product_name"] ?></b></span>
                                            <span class="some-product-price"><?= prettyPrice($some_product["product_price"]) ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php }
                        ?>
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