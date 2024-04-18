<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_GET["about-us"])) { echo("Quienes somos"); }
            elseif (isset($_GET["mission-vision-values"])) { echo("Misión, visión y valores"); }
            else { echo("Qué somos"); } ?> | NintaiSquare</title>
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
        <?php
            if (isset($_GET["about-us"])) { ?>
                <div class="content">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-users"></i>Quienes somos</h2>
                    </div>
                    <div class="body-content" id="content-about">
                        <article class="info-container">
                            <span class="info">Somos un grupo de estudiantes 
                                de secundaria del Politécnico Francisco José 
                                Peynado en República Dominicana. Creamos 
                                NintaiSquare el 22 de Enero de 2024, con 
                                la intención de ayudar a aquellos emprendedores 
                                que tienen la intención de hacer crecer su 
                                negocio de forma rápida y totalmente gratis.</span>
                        </article>
                        <div class="sub-title">
                            <h3 class="title"><i class="fa-solid fa-list-ul"></i>Lista de integrantes.</h3>
                        </div>
                        <article class="member-container">
                            <div class="header-member-container">
                                <div class="img-member">
                                    <span class="no-image">Sin foto.</span>
                                    <!--<img src="../sources/assets/img/logo-socials-negro.png" alt="" title="">-->
                                </div>
                                <div class="info-member">
                                    <div class="name">Darlin Daniel Arias Méndez</div>
                                    <div class="socials">
                                        <a href="https://github.com/Darlin-code" class="link github" target="_blank"><i class="fa-brands fa-github"></i></a>
                                        <a href="https://www.linkedin.com/in/darlin-dev/" class="link linkedin" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                                        <a href="mailto:darlin.informatica@gmail.com?subject=Hola, Darlin." class="link email"><i class="fa-solid fa-envelope"></i></a>
                                        <a href="https://www.instagram.com/zd_drip/" class="link instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="https://twitter.com/zd_zzz_" class="link twitter" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="content-member-container">
                                <span class="description">
                                    Estudiante de secundaria y actual CEO de NintaiSquare.<br>
                                    <span class="nota">- "Me da pereza dirigir grupos la verdad".</span>
                                </span>
                            </div>
                        </article>
                        <div class="divisor"></div>
                    </div>
                </div>
            <?php } elseif (isset($_GET["mission-vision-values"])) { ?>
                <div class="content">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-handshake"></i>Misión, visión y valores.</h2>
                    </div>
                    <div class="body-content" id="mvv">
                        <article class="info-container">
                            <div class="header-article">
                                <h3 class="title">Misión</h3>
                            </div>
                            <span class="info">Nintaisquare es una empresa que 
                                te ayuda a ti y tu negocio a poder crecer a nivel 
                                empresarial, brindandote un espacio totalmente 
                                gratuito en nuestra plataforma para poder darle 
                                promocion a tu negocio.</span>
                        </article>
                        <article class="info-container">
                            <div class="header-article">
                                <h3 class="title">Visión</h3>
                            </div>
                            <span class="info">Los usuarios podran ver los diferentes 
                                productos que registres en tu tienda, junto con sus 
                                detalles y distintos precios. Para facilitar la 
                                compra de sus productos.</span>
                        </article>
                        <article class="info-container">
                            <div class="header-article">
                                <h3 class="title">Valores</h3>
                            </div>
                            <span class="info">También contamos con un sistema de 
                                soporte para que los usuarios puedan tener respuesta 
                                a sus incovenientes o reportar problemas que hayan 
                                surgido, para que nuestro equipo los solucione lo 
                                antes posible.</span>
                        </article>
                    </div>
                </div>
            <?php } else { ?>
                <div class="content">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-users"></i>Qué somos</h2>
                    </div>
                    <div class="body-content">
                        <article class="info-container">
                            <span class="info">Nintaisquare es una empresa que 
                                te ayuda a ti y tu negocio a poder crecer a nivel 
                                empresarial, brindandote un espacio totalmente 
                                gratuito en nuestra plataforma para poder darle 
                                promocion a tu negocio.</span>
                        </article>
                        <article class="info-container">
                            <span class="info">Los usuarios podran ver los diferentes 
                                productos que registres en tu tienda, junto con sus 
                                detalles y distintos precios. Para facilitar la 
                                compra de sus productos.</span>
                        </article>
                        <article class="info-container">
                            <span class="info">También contamos con un sistema de 
                                soporte para que los usuarios puedan tener respuesta 
                                a sus incovenientes o reportar problemas que hayan 
                                surgido, para que nuestro equipo los solucione lo 
                                antes posible.</span>
                        </article>
                    </div>
                </div>
            <?php }
        ?>
        <?php
            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>