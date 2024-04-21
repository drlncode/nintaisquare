<?php
    session_start();
    require_once("../funciones.php");
    require_once("../pdo.php");
    noset();
    $admin = new admin_validation; //Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirm();

    if (isset($_GET["salir"])) {
        unset($_SESSION["USER_AUTH"]["admin_confirm"]);
        header("Location: https://nintaisquare.com/");
        exit;
    }

    if (isset($_GET["update"])) {
        $all_data = [];

        //*Datos de las tiendas.
        $stores_data = [];

        //Parte 1.
        $query_stores_count = $pdo -> query("SELECT store_id FROM val_stores");
        array_push($stores_data, ["count_total" => $query_stores_count -> rowCount()]);

        //Parte 2.
        $query_stores_accepted = $pdo -> query("SELECT id FROM history WHERE `status` = 'accepted' AND `category` = 'store'");
        array_push($stores_data, ["stores_accepted" => $query_stores_accepted -> rowCount()]);

        //Parte 3.
        $query_stores_denied = $pdo -> query("SELECT id FROM history WHERE `status` = 'denied' AND `category` = 'store'");
        array_push($stores_data, ["stores_denied" => $query_stores_denied -> rowCount()]);
        
        //Parte 4.
        $query_stores_deleted = $pdo -> query("SELECT id FROM history WHERE `status` = 'deleted' AND `category` = 'store'");
        $deleted_stores = $query_stores_deleted -> rowCount();
        
        //Parte 5.
        $query_stores_deleted_all = $pdo -> query("SELECT id FROM history WHERE `status` = 'deleted_all' AND `category` = 'store'");
        array_push($stores_data, ["stores_deleted" => $deleted_stores += $query_stores_deleted_all -> rowCount()]);
        array_push($all_data, $stores_data);

        //*Datos de los productos.
        $products_data = [];

        //Parte 1.
        $query_products_count = $pdo -> query("SELECT product_id FROM val_products");
        array_push($products_data, ["count_total" => $query_products_count -> rowCount()]);

        //Parte 2.
        $query_products_accepted = $pdo -> query("SELECT id FROM history WHERE `status` = 'accepted' AND `category` = 'product'");
        array_push($products_data, ["products_accepted" => $query_products_accepted -> rowCount()]);

        //Parte 3.
        $query_products_denied = $pdo -> query("SELECT id FROM history WHERE `status` = 'denied' AND `category` = 'product'");
        array_push($products_data, ["products_denied" => $query_products_denied -> rowCount()]);

        //Parte 4. 
        $query_products_deleted = $pdo -> query("SELECT id FROM history WHERE `status` = 'deleted' AND `category` = 'product'");
        $deleted_products = $query_products_deleted -> rowCount();

        //Parte 5.
        $query_products_deleted_all = $pdo -> query("SELECT id FROM history WHERE `status` = 'deleted_all' AND `category` = 'product'");
        array_push($products_data, ["products_deleted" => $deleted_products += $query_products_deleted_all -> rowCount()]);
        array_push($all_data, $products_data);

        //*Datos de los usuarios.
        $users_data = [];

        //Parte 1.
        $query_users_count = $pdo -> query("SELECT user_id FROM users;");
        array_push($users_data, ["count_total" => $query_users_count -> rowCount()]);

        //Parte 2.
        $query_admins_count = $pdo -> query("SELECT user_id FROM users WHERE admin = '1'");
        array_push($users_data, ["count_admins_total" => $query_admins_count -> rowCount()]);

        //Parte 3. 
        $query_noadmins_count = $pdo -> query("SELECT user_id FROM users WHERE admin = '0'");
        array_push($users_data, ["count_no_admins_total" => $query_noadmins_count -> rowCount()]);

        //Parte 4.
        $users_deleted_count = $pdo -> query("SELECT id FROM history WHERE `status` = 'deleted' AND `category` = 'user'");
        array_push($users_data, ["count_users_deleted" => $users_deleted_count -> rowCount()]);
        array_push($all_data, $users_data);

        $json = json_encode($all_data);
        file_put_contents("data/statistics.json", $json);
        header("Location: index.php");
        exit;
    } else {
        $statistics = json_decode("https://nintaisquare.com/sources/controller/admin/data/statistics.json", true);
        var_dump($statistics);
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
            <div class="header">
                <h1 class="title-statistics"><i class="fa-solid fa-chart-column"></i>Estadísticas generales</h1>
                <a href="<?= $_SERVER["REQUEST_URI"] ?>?update" class="update">Actualizar<i class="fa-solid fa-arrows-rotate"></i></a>
            </div>
            <div class="statistics-container">
                <ul class="statistics-content"><p class="statistic-title"><i class="fa-solid fa-shop"></i>Tiendas</p>
                    <li class="statistic-value">Total:</li>
                    <li class="statistic-value">Aceptadas:</li>
                    <li class="statistic-value">Rechazadas:</li>
                    <li class="statistic-value">Eliminadas:</li>
                </ul>
                <ul class="statistics-content"><p class="statistic-title"><i class="fa-solid fa-cart-shopping"></i>Productos</p>
                    <li class="statistic-value">Total:</li>
                    <li class="statistic-value">Aceptados:</li>
                    <li class="statistic-value">Rechazados:</li>
                    <li class="statistic-value">Eliminados:</li>
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