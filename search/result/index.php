<?php
    session_start(); //Done
    require_once("../../sources/controller/funciones.php");
    require_once("../../sources/controller/pdo.php");
    noset();

    if (isset($_GET["query"]) && empty($_GET["query"])) {
        if (isset($_GET["str"])) {
            header("Location: ../?filter=str");
            exit;
        } elseif (isset($_GET["pdt"])) {
            header("Location: ../?filter=pdt");
            exit;
        } else {
            header("Location: ../");
            exit;
        }
    } elseif (!empty($_GET["query"]) && isset($_GET["str"])) {
        $petitionStr = htmlentities($_GET["query"]);

        //Query filtrada para las tiendas.
        $queryStr = $pdo -> prepare("SELECT * FROM val_stores WHERE store_name LIKE '%$petitionStr%'");
        $queryStr -> execute();
        $countStr = $queryStr -> rowCount();
    } elseif (!empty($_GET["query"]) && isset($_GET["pdt"])) {
        $petitionPdt = htmlentities($_GET["query"]);

        //Query filtrada para los productos.
        $queryPdt = $pdo -> prepare("SELECT * FROM val_products WHERE product_name LIKE '%$petitionPdt%'");
        $queryPdt -> execute();
        $countPdt = $queryPdt -> rowCount();
    } elseif (isset($_GET["query"]) && empty($_GET["str"]) && empty($_GET["pdt"])) {
        $petitionAll = htmlentities($_GET["query"]);

        //Query 1 para las tinedas.
        $queryStr = $pdo -> prepare("SELECT * FROM val_stores WHERE store_name LIKE '%$petitionAll%'");
        $queryStr -> execute();
        $countStr = $queryStr -> rowCount();

        //Query 2 para los productos.
        $queryPdt = $pdo -> prepare("SELECT * FROM val_products WHERE product_name LIKE '%$petitionAll%'");
        $queryPdt -> execute();
        $countPdt = $queryPdt -> rowCount();

        $countAll = ($countStr + $countPdt);
    } else {
        header("Location: ../");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de búsqueda | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../../sources/assets/styles/search-result.css">
    <link rel="stylesheet" href="../../sources/assets/styles/no-responsive.css">
    <link rel="icon" type="image/x-icon" href="../../sources/assets/img/favicon.png">
</head>
    <?php
        require_once("../../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <?php
            require_once("../../sources/templates/header/header-login.php");
        ?>
        <div class="search-results-container">
            <?php 
                if (!isset($_GET["str"]) && !isset($_GET["pdt"])) { ?>
                    <div class="results-header">
                        <h2><i class="fa-solid fa-scroll"></i><?= $countAll . " resultado(s) para " ?><b>"<?=$_GET['query']?>".</b></h2>
                        <a href="?back" class="back"><i class="fa-solid fa-arrow-left"></i>Volver a buscar</a>
                    </div>
                    <div class="results-content">
                        <div class="results-stores">
                            <div class="results-stores-header">
                                <h3 class="title"><i class="fa-solid fa-shop"></i>Tiendas (<?= $countStr ?>)</h3>
                            </div>
                            <div class="results">
                                <?php 
                                    if ($countStr == 0) { ?>
                                        <span class="no-results"><i class="fa-solid fa-question"></i>Sin coincidencias.</span>
                                    <?php } else {
                                        while ($storeResult = $queryStr -> fetch(PDO::FETCH_ASSOC)) { ?>
                                            <a href="https://nintaisquare.com/store/?store_id=<?= $storeResult["store_id"] ?>" class="folder" target="_blank">
                                                <div class="result-store">
                                                    <div class="result-store-img">
                                                        <img src="data:img/png;base64,<?= $storeResult["store_img"]; ?>" alt="">
                                                    </div>
                                                    <div class="result-store-details">
                                                        <div class="result-store-name">
                                                            <span class="name"><?= $storeResult["store_name"]; ?></span>
                                                        </div>
                                                        <div class="result-store-category">
                                                            <span class="category"><?= prettyCategory($storeResult["store_category"]); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="results-products">
                            <div class="results-products-header">
                                <h3 class="title"><i class="fa-solid fa-cart-shopping"></i>Productos (<?= $countPdt ?>)</h3>
                            </div>
                            <div class="results">
                                <?php 
                                    if ($countPdt == 0) { ?>
                                        <span class="no-results"><i class="fa-solid fa-question"></i>Sin coincidencias.</span>
                                    <?php } else {
                                        while ($productResult = $queryPdt -> fetch(PDO::FETCH_ASSOC)) { ?>
                                            <a href="https://nintaisquare.com/product/?product_id=<?= $productResult["product_id"] ?>" class="folder" target="_blank">
                                                <div class="result-product">
                                                    <div class="result-product-img">
                                                        <img src="data:img/png;base64,<?= $productResult["product_img"]; ?>" alt="">
                                                    </div>
                                                    <div class="result-product-details">
                                                        <div class="result-product-name">
                                                            <span class="name"><?= $productResult["product_name"]; ?></span>
                                                        </div>
                                                        <div class="result-product-category">
                                                            <span class="category"><?= prettyCategory($productResult["product_category"]); ?></span>
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
                <?php } else {
                    if (isset($_GET["str"])) { ?>
                        <div class="search-results">
                            <div class="results-header">
                                <h2><i class="fa-solid fa-scroll"></i><?= $countStr . " resultado(s) para " ?><b>"<?=$_GET['query']?>"</b></h2>
                                <a href="?back" class="back"><i class="fa-solid fa-arrow-left"></i>Volver a buscar</a>
                            </div>
                            <div class="results-content">
                                <div class="resuls-filtred-header">
                                    <h3 class="title"><i class="fa-solid fa-shop"></i>Tiendas</h3>
                                </div>
                                <div class="results">
                                    <?php
                                        if ($countStr == 0) { ?>
                                            <span class="no-results"><i class="fa-solid fa-question"></i>Sin coincidencias.</span>
                                        <?php } else {
                                            while ($storeResult = $queryStr -> fetch(PDO::FETCH_ASSOC)) { ?>
                                                <a href="https://nintaisquare.com/store/?store_id=<?= $storeResult["store_id"] ?>" class="folder" target="_blank">
                                                    <div class="result-filtred">
                                                        <div class="result-filtred-img">
                                                            <img src="data:img/png;base64,<?= $storeResult["store_img"]; ?>" alt="">
                                                        </div>
                                                        <div class="result-filtred-details">
                                                            <div class="result-filtred-name">
                                                                <span class="name"><?= $storeResult["store_name"]; ?></span>
                                                            </div>
                                                            <div class="result-filtred-category">
                                                                <span class="category"><?= prettyCategory($storeResult["store_category"]); ?></span>
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
                    <?php } elseif (isset($_GET["pdt"])) { ?>
                        <div class="search-results">
                            <div class="results-header">
                                <h2><i class="fa-solid fa-scroll"></i><?= $countPdt . " resultado(s) para " ?><b>"<?=$_GET['query']?>"</b></h2>
                                <a href="?back" class="back"><i class="fa-solid fa-arrow-left"></i>Volver a buscar</a>
                            </div>
                            <div class="results-content">
                                <div class="resuls-filtred-header">
                                    <h3 class="title"><i class="fa-solid fa-cart-shopping"></i>Productos</h3>
                                </div>
                                <div class="results">
                                    <?php
                                        if ($countPdt == 0) { ?>
                                            <span class="no-results"><i class="fa-solid fa-question"></i>Sin coincidencias.</span>
                                        <?php } else {
                                            while ($productResult = $queryPdt -> fetch(PDO::FETCH_ASSOC)) { ?>
                                                <a href="https://nintaisquare.com/product/?sproduct_id=<?= $productResult["product_id"] ?>" class="folder" target="_blank">
                                                    <div class="result-filtred">
                                                        <div class="result-filtred-img">
                                                            <img src="data:img/png;base64,<?= $productResult["product_img"]; ?>" alt="">
                                                        </div>
                                                        <div class="result-filtred-details">
                                                            <div class="result-filtred-name">
                                                                <span class="name"><?= $productResult["product_name"]; ?></span>
                                                            </div>
                                                            <div class="result-filtred-category">
                                                                <span class="category"><?= prettyCategory($productResult["product_category"]); ?></span>
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
                    <?php }
                }
            ?>
        </div>
        <?php
            require_once("../../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>