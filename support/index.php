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
    <meta name="description" content="Soporte NintaiSquare">
    <meta name="description" content="Te damos la bienvenida a la sección de soporte de NintaiSquare">
    <title>Soporte | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/support.css">
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon-support.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }
        ?>
        <div class="header-container">
            <div class="logo-text">
                <img src="../sources/assets/img/logo-socials-negro.png">
                <h3 class="header-text">Soporte</h3>
            </div>
            <div class="user">
                <?php
                    if (!isset($_SESSION["USER_AUTH"])) { ?>
                        <a href="https://nintaisquare.com/user/signin.php?support" class="login"><i class="fa-solid fa-right-to-bracket"></i>Iniciar sesión</a>
                    <?php } else { ?>
                        <a href="https://nintaisquare.com/user/profile.php?user_id=<?= $_SESSION["USER_AUTH"]["user_id"] ?>" class="account" target="_blank" title="<?= $_SESSION["USER_AUTH"]["name"] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
                            <p class="text"><?= $_SESSION["USER_AUTH"]["name_parts"][0] ?></p>
                        </a>
                    <?php }
                ?>
            </div>
        </div>
        <div class="content">
            <div class="sub-header-container">
                <h1 class="sub-header-title"><i class="fa-solid fa-headset"></i>Soporte</h1>
                <span class="sub-header-text">Te damos la bienvenida a la sección de soporte de NintaiSquare, aqui podrás ponerte en contacto con nuestro personal para resolver tus dudas o incovenientes.</span>
            </div>
            <div class="options-container">
                <a href="">
                    <div class="option contact-us">
                        <div class="option-title">
                            <h3 class="title"><i class="fa-solid fa-comments"></i>Contáctanos</h3>
                        </div>
                        <div class="option-content">
                            <span class="text">Podrás descubrir como ponerte en contacto con nuestro equipo.</span>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="option report-something">
                        <div class="option-title">
                            <h3 class="title"><i class="fa-solid fa-triangle-exclamation"></i>Reportar un error</h3>
                        </div>
                        <div class="option-content">
                            <span class="text">Reporta cualquier error que surga en la plataforma para su pronta solución.</span>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="option how-use">
                        <div class="option-title">
                            <h3 class="title"><i class="fa-solid fa-circle-question"></i>Cómo utilizar</h3>
                        </div>
                        <div class="option-content">
                            <span class="text">Descubre todo acerca de como utilizar NintaiSquare y sus funcionalidades.</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="support-questions" id="frequent-questions">
                <h2 class="title"><i class="fa-regular fa-circle-question"></i>Preguntas frecuentes</h2>
                <div class="questions">
                    <details>
                        <summary>Que es NintaiSquare?</summary>
                        <p class="p-text"></p>
                    </details>
                    <details>
                        <summary>Tengo que pagar?</summary>
                        <p class="p-text"></p>
                    </details>
                    <details>
                        <summary>Cuantas tiendas y productos puedo registrar?</summary>
                        <p class="p-text"></p>
                    </details>
                    <details>
                        <summary>Cuanto tiempo tardan en aprobar mi tienda/productos?</summary>
                        <p class="p-text"></p>
                    </details>
                    <details>
                        <summary>Perdí mi cuenta, como la recupero?</summary>
                        <p class="p-text"></p>
                        <div id="last" style="display: none;"></div>
                    </details>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-container">
            <a href="https://nintaisquare.com/">
                <div class="img">
                    <img src="../sources/assets/img/logo-blanco.png" alt="NintaiSquare Logo" title="NintaiSquare">
                </div>
            </a>
            <div class="text"><i class="fa-regular fa-copyright"></i>NintaiSquare - Todos los derechos reservados.</div>
            <div class="socials">
                <a href="https://github.com/Darlin-code/nintaisquare" target="_blank" title="Github - NintaiSquare"><i class="fa-brands fa-github"></i></a>
                <a href="https://www.instagram.com/nintaisquare/" target="_blank" title="Instagram - NintaiSquare"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://twitter.com/NintaiSquare" target="_blank" title="Twitter - NintaiSquare"><i class="fa-brands fa-twitter"></i></a>
            </div>
    </footer>
</body>
</html>