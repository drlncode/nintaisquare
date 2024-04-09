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
                        <a href="https://nintaisquare.com/user/signin.php?support" class="login" target="_blank"><i class="fa-solid fa-right-to-bracket"></i>Iniciar sesión</a>
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
                <h1 class="sub-header-title">Soporte NintaiSquare</h1>
                <span class="sub-header-text">Te damos la bienvenida a la sección de soporte de NintaiSquare, aqui podrás ponerte en contacto con nuestro personal para resolver tus dudas o incovenientes.</span>
            </div>
            <div class="support-questions">
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
</body>
</html>