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

        </div>
        <?php
            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>