<?php
    session_start();
    require_once("../../funciones.php");
    require_once("../../pdo.php");
    noset();
    $admin = new admin_validation; //Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirm();

    if (isset($_GET["salir"])) {
        unset($_SESSION["USER_AUTH"]["admin_confirm"]);
        header("Location: https://nintaisquare.com/");
        return;
    } elseif (isset($_GET["accept-store"])) {
    } elseif (isset($_GET["deny-store"])) {
    }

    //Solicitando datos para las notificaciones (Tiendas pendientes).
    $query = $pdo -> query("SELECT COUNT(*) hold FROM pen_stores;");
    $pen_stores = $query -> fetch(PDO::FETCH_ASSOC);

    //Solicitando datos para las notificaciones (Productos pendientes).
    $query = $pdo -> query("SELECT COUNT(*) hold FROM pen_products;");
    $pen_products = $query -> fetch(PDO::FETCH_ASSOC);

    //Solicitando datos para las notificaciones (Lista de usuarios).
    $query = $pdo -> query("SELECT COUNT(*) users FROM users;");
    $users = $query -> fetch(PDO::FETCH_ASSOC);

    //Solicitando datos para las notificaciones (Lista de tiendas).
    $query = $pdo -> query("SELECT COUNT(*) val FROM val_stores;");
    $val_stores = $query -> fetch(PDO::FETCH_ASSOC);

    //Solicitando datos para las notificaciones (Lista de productos).
    $query = $pdo -> query("SELECT COUNT(*) val FROM val_products;");
    $val_products = $query -> fetch(PDO::FETCH_ASSOC);
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
                if (isset($_GET["store_id"])) { ?>
                    <?php
                        $query = "SELECT * FROM pen_stores WHERE store_id = :id";
                        $pre = $pdo -> prepare($query);
                        $pre -> execute(Array(
                            ':id' => $_GET["store_id"]
                        ));
                        $store = $pre -> fetch(PDO::FETCH_ASSOC);
                        
                        if (!empty($store)) {
                            $query = $pdo -> prepare("SELECT user_id, name FROM users WHERE user_id = :id");
                            $query -> execute(array(
                                ':id' => $store["user_id"]
                            ));
                            $user = $query -> fetch(PDO::FETCH_ASSOC);
                        } else {
                            header("Location: index.php?on-hold-stores");
                            return;
                        }
                    ?>
                    <div class="container-store-details">
                        <div class="title-container">
                            <h2 class="title"><i class="fa-regular fa-file-lines"></i>Detalles de la tienda.</h2>
                        </div>
                        <div class="header-content">
                            <div class="back">
                                <a href="index.php?on-hold-stores" class="back-button"><i class="fa-solid fa-arrow-left"></i>Volver</a>
                            </div>
                            <div class="user">
                                <h3 class="user-idname-title"><i class="fa-solid fa-user"></i>Usuario</h3>
                                <p class="user-idname">ID: <i><?= $user["user_id"] ?></i> | Nombre: <i><?= $user["name"] ?></i></p>
                                <div class="profile">
                                    <a href="https://nintaisquare.com/user/profile.php?user_id=<?= $user["user_id"] ?>" target="_blank" class="go-profile">Ver perfil<i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="divisors">
                            <div class="divisor-1">
                                <div class="data">
                                    <p class="data-title">Nombre de la tienda:</p>
                                    <i class="data-info"><?= $store["store_name"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Categoria de la tienda:</p>
                                    <i class="data-info"><?= $store["store_category"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Descripción de la tienda:</p>
                                    <i class="data-info"><?= $store["store_desc"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Teléfono de la tienda:</p>
                                    <i class="data-info"><?= $store["store_tel"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Correo de la tienda:</p>
                                    <i class="data-info"><?= $store["store_email"] ?></i>
                                </div>
                            </div>
                            <div class="divisor-2">
                                <div class="data-image">
                                    <p class="data-title">Imagen de la tienda:</p>
                                    <img src="data:image/png;base64,<?= $store["store_img"] ?>" alt="Imagen de <?= $store["store_name"] ?>" class="store-img" title="Imagen de <?= $store["store_name"] ?>" />
                                </div>
                                <div class="data">
                                    <p class="data-title">Redes de la tienda:</p>
                                    <p class="data-info"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="container-stores">
                        <div class="title-container">
                            <h2 class="title"><i class="fa-solid fa-hourglass-half"></i>Tiendas en espera.</h2>
                        </div>
                        <div class="stores">
                            <div class="stores-captions">
                                <div class="user-caption">
                                    <p>ID Usuario</p>
                                </div>
                                <div class="store-caption">
                                    <p>Nombre de la tienda</p>
                                </div>
                                <div class="store-actions">
                                    <p>Acciones</p>
                                </div>
                            </div>
                            <?php
                                $query = $pdo -> query("SELECT store_id, user_id, store_name FROM pen_stores;");
                                while ($hold_store = $query -> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="store">
                                        <div class="user-info">
                                            <p><a href="https://nintaisquare.com/user/profile.php?user_id=<?= $hold_store['user_id'] ?>" target="_blank"><?= $hold_store["user_id"] ?></a></p>
                                        </div>
                                        <div class="store-name">
                                            <p><?= $hold_store["store_name"] ?></p>
                                        </div>
                                        <div class="actions">
                                            <a href="index.php?on-hold-stores&store_id=<?= $hold_store['store_id'] ?>">
                                                <div class="option details"><p>Detalles</p></div>
                                            </a>
                                            <a href="index.php?on-hold-stores&accept-store=<?= $hold_store['store_id'] ?>">
                                                <div class="option accept"><p>Aceptar</p></div>
                                            </a>
                                            <a href="index.php?on-hold-stores&deny-store=<?= $hold_store['store_id'] ?>">
                                                <div class="option deny"><p>Rechazar</p></div>
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                <?php }
            } elseif (isset($_GET["on-hold-products"])) {
                if (isset($_GET["product_id"])) { ?>
                    <div class="container-product-details"></div>
                <?php } else { ?>
                    <div class="conatainer-products"></div>
                <?php }
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
                                <div class="option-notify"><p><?= $pen_stores["hold"] ?></p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-hourglass-half"></i>Tiendas en espera</p></div>
                            </a>
                            <a href="index.php?on-hold-products">
                                <div class="option-notify"><p><?= $pen_products["hold"] ?></p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-hourglass-half"></i>Productos en espera</p></div>
                            </a>
                        </div>
                    </div>
                    <div class="general-option div-2-options">
                        <div class="option-title"><h3 class="title"><i class="fa-solid fa-list"></i>Registro.</h3></div>
                        <div class="container-options">
                            <a href="index.php?users-list">
                                <div class="option-notify"><p><?= $users["users"] ?></p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-users"></i>Lista de usuarios</p></div>
                            </a>
                            <a href="index.php?stores-list">
                                <div class="option-notify"><p><?= $val_stores["val"] ?></p></div>
                                <div class="option"><p class="info"><i class="fa-solid fa-shop"></i>Lista de tiendas</p></div>
                            </a>
                            <a href="index.php?products-list">
                                <div class="option-notify"><p><?= $val_products["val"] ?></p></div>
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