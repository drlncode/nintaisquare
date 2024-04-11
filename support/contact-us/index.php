<?php
    session_start();
    require_once("../../sources/controller/pdo.php");
    require_once("../../sources/controller/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contácto NintaiSquare">
    <title>Contáctanos | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../../sources/assets/styles/support.css">
    <link rel="icon" type="image/x-icon" href="../../sources/assets/img/favicon-support.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }

            require_once("../../sources/templates/support/support-header.php");
        ?>
        <div class="contact-content">
            <div class="header">
                <h2 class="title">¿Cómo ponerte en contácto con nuestro equipo?<a href="../" class="back"><i class="fa-solid fa-arrow-left"></i>Ir al contenido principal</a></h2>
            </div>
            <article class="info-container">
                <p class="alert" style="<?= isset($_GET["recover-account"]) ? 'background-color: var(--border-color);' : '' ?>""><i class="fa-solid fa-circle-info"></i>Si estás aquí porque quieres recuperar tu cuenta o contraseña, escríbenos vía correo electrónico.</p>
                <p class="info">Actualmente los usuarios cuentan con 3 medios para comunicarse con nuestro equipo. Los cuales son: <b>Email</b>, <b>Instagram</b> y <b>Twitter</b>. Mediante estos, los usuarios pueden realizar preguntas o comentarle al equipo de desarrollo cualquier problemática con la que esté lidiando el usuario. Normalmente el tiempo de respuesta será como máximo de 24 horas, por lo que les pedimos paciencia de antemano.</p>
            </article>
            <div class="socials-container">
                <div class="social">
                    <a href="mailto:nintaisquare@nintaisquare.com" class="link"><i class="fa-solid fa-envelope"></i>Correo electrónico.</a>
                </div>
                <div class="social">
                    <a href="https://www.instagram.com/nintaisquare/" class="link"><i class="fa-brands fa-instagram"></i>Instagram.</a>
                </div>
                <div class="social">
                    <a href="https://twitter.com/nintaisquare" class="link"><i class="fa-brands fa-twitter"></i>Twitter.</a>
                </div>
            </div>
        </div>
        <?php
            require_once("../../sources/templates/support/support-footer.php");
        ?>
    </div>
</body>
</html>