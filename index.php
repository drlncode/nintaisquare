<?php
    session_start();
    require_once("sources/controller/funciones.php");
    set();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="sources/assets/styles/root.css">
    <link rel="stylesheet" href="sources/assets/styles/index-nl.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="icon" type="image/x-icon" href="sources/assets/img/favicon.png">
</head>
<body>
    <?php
        require_once("../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
    <?php
        if (!isset($_SESSION["USER_AUTH"])) {
            require_once("sources/templates/header/header-no-login.php");
            require_once("sources/templates/home/index-no-login.php");
            require_once("sources/templates/footer/footer.php");
        } else {
            //header("Location: home/");
        }
    ?>
    </div>
</body>
</html>