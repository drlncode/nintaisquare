<?php
    session_start();
    require_once("../../funciones.php");
    noset();
    $admin = new admin_validation; //Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirm();

    if (isset($_GET["salir"])) {
        unset($_SESSION["USER_AUTH"]["admin_confirm"]);
        header("Location: https://nintaisquare.com/");
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control | NintaiSquare</title>
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/admin-panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon" href="../../../assets/img/favicon.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }
        ?>
        <div class="admin-header-container">
            <div class="admin-header-content">
                <div class="content-img">
                    <img src="../../../assets/img/logo.png" alt="Logo">
                </div>
                <div class="content-nav">
                    <ul class="nav-list-container">
                        <li class="nav-list-content"><a href="../">Inicio</a></li>
                        <li class="nav-list-content"><a href="../panel/">Panel</a></li>
                        <li class="nav-list-content"><a href="../history/">Historial</a></li>
                    </ul>
                </div>
                <div class="content-out">
                    <a href="index.php?salir"><i class="fa-solid fa-arrow-right-from-bracket"></i>Salir</a>
                </div>
            </div>
        </div>
        <?php
            if (isset($_GET["on-hold-stores"])) {

            } elseif (isset($_GET["on-hold-products"])) {

            } elseif (isset($_GET["users-list"])) {
                
            } elseif (isset($_GET["stores-list"])) {

            } elseif (isset($_GET["products-list"])) {

            } else { ?>
                <div class="panel-container">
                    <div class="title-container">
                        <h2 class="title"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" --darkreader-inline-fill: #e8e6e3;" data-darkreader-inline-fill=""><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm5 2h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm1-6h4v4h-4V5zM3 20a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6zm2-5h4v4H5v-4zm8 5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6zm2-5h4v4h-4v-4z"></path></svg>Panel de control.</h2>
                    </div>
                    <div class="general-option div-1-options">
                        <div class="option-title"><h3 class="title"><i class="fa-solid fa-hourglass-half"></i>Solicitides de incorporación.</h3></div>
                        <div class="container-options">
                            <a href="index.php?on-hold-stores">
                                <div class="option-notify"><p>0</p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-hourglass-half"></i>Tiendas en espera</p></div>
                            </a>
                            <a href="index.php?on-hold-products">
                                <div class="option-notify"><p>0</p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-hourglass-half"></i>Productos en espera</p></div>
                            </a>
                        </div>
                    </div>
                    <div class="general-option div-2-options">
                        <div class="option-title"><h3 class="title"><i class="fa-solid fa-list"></i>Registro.</h3></div>
                        <div class="container-options">
                            <a href="index.php?users-list">
                                <div class="option-notify"><p>0</p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-users"></i>Lista de usuarios</p></div>
                            </a>
                            <a href="index.php?stores-list">
                                <div class="option-notify"><p>0</p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-shop"></i>Lista de tiendas</p></div>
                            </a>
                            <a href="index.php?products-list">
                                <div class="option-notify"><p>0</p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-cart-shopping"></i>Lista de productos</p></div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
        ?>
    </div>
</body>
</html>