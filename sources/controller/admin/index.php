<?php
    session_start();
    require_once("../funciones.php");
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
    <title>Administración | NintaiSquare</title>
    <link rel="stylesheet" href="../../assets/styles/root.css">
    <link rel="stylesheet" href="../../assets/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.png">
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
                    <img src="../../assets/img/logo.png" alt="Logo">
                </div>
                <div class="content-nav">
                    <ul class="nav-list-container">
                        <li class="nav-list-content"><a href="../admin/">Inicio</a></li>
                        <li class="nav-list-content"><a href="panel/">Panel</a></li>
                        <li class="nav-list-content"><a href="history/">Historial</a></li>
                    </ul>
                </div>
                <div class="content-out">
                    <a href="index.php?salir"><i class="fa-solid fa-arrow-right-from-bracket"></i>Salir</a>
                </div>
            </div>
        </div>
        <div class="admin-statistics-container">
            <h1 class="title-statistics"><i class="fa-solid fa-chart-column"></i>Estadísticas generales</h1>
            <div class="statistics-container">
                <ul class="statistics-content"><p class="statistic-title"><i class="fa-solid fa-shop"></i>Tiendas</p>
                    <li class="statistic-value">Total:</li>
                    <li class="statistic-value">Aceptadas:</li>
                    <li class="statistic-value">Rechazadas:</li>
                </ul>
                <ul class="statistics-content"><p class="statistic-title"><i class="fa-solid fa-cart-shopping"></i>Productos</p>
                    <li class="statistic-value">Total:</li>
                    <li class="statistic-value">Aceptados:</li>
                    <li class="statistic-value">Rechazados:</li>
                </ul>
                <ul class="statistics-content"><p class="statistic-title"><i class="fa-solid fa-users"></i>Usuarios</p>
                    <li class="statistic-value">Total:</li>
                    <li class="statistic-value">Administradores:</li>
                    <li class="statistic-value">Usuarios:</li>
                    <li class="statistic-value">Eliminados:</li>
                </ul>      
            </div>  
        </div>
    </div>  
</body>
</html>