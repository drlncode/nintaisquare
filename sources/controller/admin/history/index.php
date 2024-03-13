<?php
    session_start();
    require_once("../../funciones.php");
    require_once("../../pdo.php");
    noset();
    $admin = new admin_validation; //Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirm();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial | NintaiSquare</title>
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/admin-history.css">
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
        <div class="history-container">
            <div class="history-container-header">
                <div class="title-content"><h2 class="title"><i class="fa-solid fa-clock-rotate-left"></i>Historial</h2></div>
            </div>
            <div class="hostory-register-container">
                <div class="hostory-register">
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>