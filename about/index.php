<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nosotros | NintaiSquare</title>
    <link rel="stylesheet" href="../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../sources/assets/styles/about.css">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
        <div class="content">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-users"></i>Que sómos</h2>
            </div>
            <div class="body-content">
                <article class="info">
                    <span class="info">Nintaisquare es una empresa que te ayuda a ti y tu empresa a poder crecer a nivel empresarial brindandote un espacio totalmente gratuito en nuestro sitio web para poder darle promocion a tu negocio.</span>
                </article>
                <article class="info">
                    <span class="info">Los usuarios podran ver los diferentes productos que registres en tu tienda, junto con sus detalles y distintos precios. Para facilitar la compra de sus productos.</span>
                </article>
                <article class="info">
                    <span class="info"></span>
                </article>
            </div>
        </div>
        <?php
            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>