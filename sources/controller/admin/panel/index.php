<?php
    session_start();
    require_once("../../funciones.php");
    require_once("../../pdo.php");
    noset();
    $admin = new admin_validation; //Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirm();
    date_default_timezone_set("America/Santo_Domingo");
    $date = getdate();

    if (isset($_GET["salir"])) {
        unset($_SESSION["USER_AUTH"]["admin_confirm"]);
        header("Location: https://nintaisquare.com/");
        return;
    }

    if (isset($_GET["accept-store"]) && !empty($_GET["accept-store"])) {
        $query = $pdo -> prepare("SELECT * FROM pen_stores WHERE store_id = :id");
        $query -> execute(array(
            ':id' => $_GET["accept-store"]
        ));
        $data = $query -> fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            $query = "INSERT INTO val_stores (user_id, store_name, store_category, store_desc, store_img, store_address, store_tel, store_email, store_social_ig, store_social_tw, store_social_fc) VALUES (:uid, :sn, :sc, :sd, :si, :sa, :st, :se, :ssi, :sst, :ssf)";
            $insert = $pdo -> prepare($query);
            $insert -> execute(array(
                ':uid' => $data["user_id"],
                ':sn' => $data["store_name"],
                ':sc' => $data["store_category"],
                ':sd' => $data["store_desc"],
                ':si' => $data["store_img"],
                ':sa' => $data["store_address"],
                ':st' => $data["store_tel"],
                ':se' => $data["store_email"],
                ':ssi' => $data["store_social_ig"],
                ':sst' => $data["store_social_tw"],
                ':ssf' => $data["store_social_fc"]
            ));

            $query = $pdo -> prepare("DELETE FROM pen_stores WHERE store_id = :id;");
            $query -> execute(array(
                ':id' => $data["store_id"]
            ));

            $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
            $query -> execute(array(
                ':st' => "accepted",
                ':by' => $_SESSION["USER_AUTH"]["user_id"],
                ':cy' => "store",
                ':of' => $data["user_id"],
                ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
            ));

            $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>¡Tienda aprobada con éxito!</span>";
            header("Location: index.php?on-hold-stores");
            return;
        }
    } elseif (isset($_GET["deny-store"]) && !empty($_GET["deny-store"])) {
        $query = $pdo -> prepare("SELECT user_id, store_id FROM pen_stores WHERE store_id = :id");
        $query -> execute(array(
            ':id' => $_GET["deny-store"]
        ));
        $data = $query -> fetch(PDO::FETCH_ASSOC);

        $query = $pdo -> prepare("DELETE FROM pen_stores WHERE store_id = :id;");
        $query -> execute(array(
            ':id' => $data["store_id"]
        ));

        $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
        $query -> execute(array(
            ':st' => "denied",
            ':by' => $_SESSION["USER_AUTH"]["user_id"],
            ':cy' => "store",
            ':of' => $data["user_id"],
            ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
        ));

        $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Tienda rechazada con éxito.</span>";
        header("Location: index.php?on-hold-stores");
        return;
    } elseif (isset($_GET["accept-product"]) && !empty($_GET["accept-product"])) {
        $query = $pdo -> prepare("SELECT * FROM pen_products WHERE product_id = :id");
        $query -> execute(array(
            ':id' => $_GET["accept-product"]
        ));
        $data = $query -> fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            $query = "INSERT INTO val_products (store_id, product_name, product_category, product_price, product_img, product_desc) VALUES (:sid, :pn, :pc, :pp, :pi, :pd)";
            $insert = $pdo -> prepare($query);
            $insert -> execute(array(
                ':sid' => $data["store_id"],
                ':pn' => $data["product_name"],
                ':pc' => $data["product_category"],
                ':pp' => $data["product_price"],
                ':pi' => $data["product_img"],
                ':pd' => $data["product_desc"]
            ));

            $query = $pdo -> prepare("DELETE FROM pen_products WHERE product_id = :id;");
            $query -> execute(array(
                ':id' => $data["product_id"]
            ));

            $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
            $query -> execute(array(
                ':st' => "accepted",
                ':by' => $_SESSION["USER_AUTH"]["user_id"],
                ':cy' => "product",
                ':of' => $data["store_id"],
                ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
            ));

            $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>¡Producto aprobado con éxito!</span>";
            header("Location: index.php?on-hold-products");
            return;
        }
        $data = $query -> fetch(PDO::FETCH_ASSOC);
    } elseif (isset($_GET["deny-product"]) && !empty($_GET["deny-product"])) {
        $query = $pdo -> prepare("SELECT product_id, store_id FROM pen_products WHERE product_id = :id");
        $query -> execute(array(
            ':id' => $_GET["deny-product"]
        ));
        $data = $query -> fetch(PDO::FETCH_ASSOC);

        $query = $pdo -> prepare("DELETE FROM pen_products WHERE product_id = :id;");
        $query -> execute(array(
            ':id' => $data["product_id"]
        ));

        $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
        $query -> execute(array(
            ':st' => "denied",
            ':by' => $_SESSION["USER_AUTH"]["user_id"],
            ':cy' => "product",
            ':of' => $data["store_id"],
            ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
        ));

        $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Producto rechazado con éxito.</span>";
        header("Location: index.php?on-hold-products");
        return;
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
                                    <div class="data-info-container">
                                        <?php
                                            if (!empty($store["store_social_ig"])) {
                                                if (parse_url($store["store_social_ig"], PHP_URL_HOST) !== "www.instagram.com" || parse_url($store["store_social_ig"], PHP_URL_PATH) == NULL || parse_url($store["store_social_ig"], PHP_URL_PATH) == "/") { ?>
                                                    <p class="data-info wrong"><i class="fa-brands fa-instagram"></i> <?= $store["store_social_ig"] ?></p>
                                                <?php } else { ?>
                                                    <p class="data-info"><i class="fa-brands fa-instagram"></i> <?= $store["store_social_ig"] ?></p>
                                                <?php }
                                            }
                                            if (!empty($store["store_social_tw"])) {
                                                if (parse_url($store["store_social_tw"], PHP_URL_HOST) !== "twitter.com" || parse_url($store["store_social_tw"], PHP_URL_PATH) == NULL || parse_url($store["store_social_tw"], PHP_URL_PATH) == "/") { ?>
                                                    <p class="data-info wrong"><i class="fa-brands fa-x-twitter"></i><?= $store["store_social_tw"] ?></p>
                                                <?php } else { ?>
                                                    <p class="data-info"><i class="fa-brands fa-x-twitter"></i><?= $store["store_social_tw"] ?></p>
                                                <?php }
                                            }
                                            if (!empty($store["store_social_fc"])) {
                                                if (parse_url($store["store_social_fc"], PHP_URL_HOST) !== "web.facebook.com" || parse_url($store["store_social_fc"], PHP_URL_PATH) == NULL || parse_url($store["store_social_fc"], PHP_URL_PATH) == "/") { ?>
                                                    <p class="data-info wrong"><i class="fa-brands fa-facebook"></i><?= $store["store_social_fc"] ?></p>
                                                <?php } else { ?>
                                                    <p class="data-info"><i class="fa-brands fa-facebook"></i><?= $store["store_social_fc"] ?></p>
                                                <?php }
                                            }
                                        ?>
                                    </div>
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
                    <?php
                        $query = "SELECT * FROM pen_products WHERE product_id = :id";
                        $pre = $pdo -> prepare($query);
                        $pre -> execute(Array(
                            ':id' => $_GET["product_id"]
                        ));
                        $product = $pre -> fetch(PDO::FETCH_ASSOC);
                        
                        if (!empty($product)) {
                            $query = $pdo -> prepare("SELECT store_id, store_name, store_category FROM val_stores WHERE store_id = :id");
                            $query -> execute(array(
                                ':id' => $product["store_id"]
                            ));
                            $store = $query -> fetch(PDO::FETCH_ASSOC);
                        } else {
                            header("Location: index.php?on-hold-stores");
                            return;
                        }
                    ?>
                    <div class="container-product-details">
                        <div class="title-container">
                            <h2 class="title"><i class="fa-regular fa-file-lines"></i>Detalles del producto.</h2>
                        </div>
                        <div class="header-content">
                            <div class="back">
                                <a href="index.php?on-hold-products" class="back-button"><i class="fa-solid fa-arrow-left"></i>Volver</a>
                            </div>
                            <div class="product-assoc">
                                <h3 class="store-idname-title"><i class="fa-solid fa-shop"></i>Tienda</h3>
                                <p class="store-idname">ID: <i><?= $store["store_id"] ?></i> | Nombre: <i><?= $store["store_name"] ?></i></p>
                                <div class="store">
                                    <a href="<?= $store["store_id"] ?>" target="_blank" class="go-store">Ver tienda<i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="divisors">
                            <div class="divisor-1">
                                <div class="data">
                                    <p class="data-title">Nombre del producto:</p>
                                    <i class="data-info"><?= $product["product_name"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Categoria del producto:</p>
                                    <i class="data-info"><?= $store["store_category"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Precio del producto:</p>
                                    <i class="data-info"><?= $product["product_price"] ?></i>
                                </div>
                                <div class="data">
                                    <p class="data-title">Descripción del producto:</p>
                                    <i class="data-info"><?= $product["product_desc"] ?></i>
                                </div>
                            </div>
                            <div class="divisor-2">
                                <div class="data-image">
                                    <p class="data-title">Imagen del producto:</p>
                                    <img src="data:image/png;base64,<?= $product["product_img"] ?>" alt="Imagen de <?= $store["store_name"] ?>" class="store-img" title="Imagen de <?= $store["store_name"] ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="container-products">
                        <div class="title-container">
                            <h2 class="title"><i class="fa-solid fa-hourglass-half"></i>Productos en espera.</h2>
                        </div>
                        <div class="products">
                            <div class="products-captions">
                                <div class="storeid-caption">
                                    <p>ID Tienda</p>
                                </div>
                                <div class="productnm-caption">
                                    <p>Nombre del producto</p>
                                </div>
                                <div class="product-actions">
                                    <p>Acciones</p>
                                </div>
                            </div>
                            <?php
                                $query = $pdo -> query("SELECT product_id, store_id, product_name FROM pen_products;");
                                while ($hold_product = $query -> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="product">
                                        <div class="store-info">
                                            <p><?= $hold_product['store_id'] ?></p>
                                        </div>
                                        <div class="product-name">
                                            <p><?= $hold_product["product_name"] ?></p>
                                        </div>
                                        <div class="actions">
                                            <a href="index.php?on-hold-products&product_id=<?= $hold_product['product_id'] ?>">
                                                <div class="option details"><p>Detalles</p></div>
                                            </a>
                                            <a href="index.php?on-hold-products&accept-product=<?= $hold_product['product_id'] ?>">
                                                <div class="option accept"><p>Aceptar</p></div>
                                            </a>
                                            <a href="index.php?on-hold-products&deny-product=<?= $hold_product['product_id'] ?>">
                                                <div class="option deny"><p>Rechazar</p></div>
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                <?php }
            } elseif (isset($_GET["users-list"])) {
                $query_u = $pdo -> query("SELECT user_id, name, email, admin FROM users;");

                if (isset($_GET["delete-user"])) {
                    $query_del = $pdo -> prepare("DELETE FROM users WHERE user_id = :id");
                    $query_del -> execute(array(
                        ':id' => $_GET["delete-user"]
                    ));

                    $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
                    $query -> execute(array(
                        ':st' => "deleted",
                        ':by' => $_SESSION["USER_AUTH"]["user_id"],
                        ':cy' => "user",
                        ':of' => $_GET["delete-user"],
                        ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
                    ));

                    $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Usuario eliminado.</span>";
                    header("Location: index.php?users-list");
                    exit;
                } else { ?>
                    <div class="container-users-list">
                        <div class="header-title">
                            <div class="title-content"><h2 class="title"><i class="fa-solid fa-users"></i>Lista de usuarios</h2></div>
                        </div>
                        <div class="caption-titles">
                            <div class="caption id-caption">
                                <p>User ID</p>
                            </div>
                            <div class="caption cn-caption">
                                <p>Nombre/Correo</p>
                            </div>
                            <div class="caption acc-caption">
                                <p>Acciones</p>
                            </div>
                        </div>
                        <div class="users">
                            <?php
                                while ($user = $query_u -> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="user">
                                        <div class="user-id">
                                            <p><?= $user["user_id"] ?></p>
                                        </div>
                                        <div class="user-email-name">
                                            <div class="name">
                                                <p><?= $user["name"] ?></p>
                                            </div>
                                            <div class="email">
                                                <p><?= $user["email"] ?></p>
                                            </div>
                                        </div>
                                        <div class="actions">
                                            <a href="https://nintaisquare.com/user/profile.php?user_id=<?= $user["user_id"] ?>" target="_blank">
                                                <div class="details-user">
                                                    <p>Ver perfil</p>
                                                </div>
                                            </a>
                                            <?php
                                                if ($user["admin"] != 1) { ?>
                                                    <a href="index.php?users-list&delete-user=<?= $user["user_id"] ?>">
                                                        <div class="delete-user">
                                                            <p>Eliminar</p>
                                                        </div>
                                                    </a>
                                                <?php }
                                            ?>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                <?php }
            } elseif (isset($_GET["stores-list"])) {
                $query_s = $pdo -> query("SELECT store_id, store_name, user_id FROM val_stores;");
                $query_un = $pdo -> prepare("SELECT user_id, name FROM users WHERE user_id = :id");

                if (isset($_GET["delete-store"])) {
                    $query_del = $pdo -> prepare("DELETE FROM val_stores WHERE store_id = :id");
                    $query_del -> execute(array(
                        ':id' => $_GET["delete-store"]
                    ));

                    $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
                    $query -> execute(array(
                        ':st' => "deleted",
                        ':by' => $_SESSION["USER_AUTH"]["user_id"],
                        ':cy' => "store",
                        ':of' => $_GET["delete-store"],
                        ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
                    ));

                    $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Tienda eliminada.</span>";
                    header("Location: index.php?stores-list");
                    exit;
                } else { ?>
                    <div class="container-users-list">
                        <div class="header-title">
                            <div class="title-content"><h2 class="title"><i class="fa-solid fa-shop"></i>Lista de tiendas</h2></div>
                        </div>
                        <div class="caption-titles">
                            <div class="caption id-caption">
                                <p>Store ID</p>
                            </div>
                            <div class="caption cn-caption">
                                <p>Nombre/Dueño</p>
                            </div>
                            <div class="caption acc-caption">
                                <p>Acciones</p>
                            </div>
                        </div>
                        <div class="users">
                            <?php
                                while ($user_store = $query_s -> fetch(PDO::FETCH_ASSOC)) { 
                                    $query_un -> execute(array(
                                        ':id' => $user_store["user_id"]
                                    ));
                                    $user = $query_un -> fetch(PDO::FETCH_ASSOC);
                                    
                                    ?>
                                    <div class="user">
                                        <div class="user-id store-id">
                                            <p><?= $user_store["store_id"] ?></p>
                                        </div>
                                        <div class="user-email-name store-name">
                                            <div class="name">
                                                <p><?= $user_store["store_name"] ?></p>
                                            </div>
                                            <div class="email store-own">
                                                <p><?= $user["name"] ?> [<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $user_store["user_id"] ?>" target="_blank"><?= $user["user_id"] ?></a>]</p>
                                            </div>
                                        </div>
                                        <div class="actions">
                                            <a href="https://nintaisquare.com/store/?store_id=<?= $user_store["store_id"] ?>" target="_blank">
                                                <div class="details-user store">
                                                    <p>Ver tienda</p>
                                                </div>
                                            </a>
                                            <a href="index.php?stores-list&delete-store=<?= $user_store["store_id"] ?>">
                                                <div class="delete-user store">
                                                    <p>Eliminar</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                <?php }
            } elseif (isset($_GET["products-list"])) {
                $query_p = $pdo -> query("SELECT product_id, product_name, store_id FROM val_products;");
                $query_pn = $pdo -> prepare("SELECT store_id, store_name FROM val_stores WHERE store_id = :id");

                if (isset($_GET["delete-product"])) {
                    $pd_st = explode("-", $_GET["delete-product"]);

                    $query_del = $pdo -> prepare("DELETE FROM val_products WHERE product_id = :id");
                    $query_del -> execute(array(
                        ':id' => $pd_st[0]
                    ));

                    $query = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
                    $query -> execute(array(
                        ':st' => "deleted",
                        ':by' => $_SESSION["USER_AUTH"]["user_id"],
                        ':cy' => "product",
                        ':of' => $pd_st[0] . "01" . $pd_st[1],
                        ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
                    ));

                    $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Producto eliminado.</span>";
                    header("Location: index.php?products-list");
                    exit;
                } else { ?>
                    <div class="container-users-list">
                        <div class="header-title">
                            <div class="title-content"><h2 class="title"><i class="fa-solid fa-cart-shopping"></i>Lista de productos</h2></div>
                        </div>
                        <div class="caption-titles">
                            <div class="caption id-caption">
                                <p>Product ID</p>
                            </div>
                            <div class="caption cn-caption">
                                <p>Nombre/Tienda</p>
                            </div>
                            <div class="caption acc-caption">
                                <p>Acciones</p>
                            </div>
                        </div>
                        <div class="users">
                            <?php
                                while ($product = $query_p -> fetch(PDO::FETCH_ASSOC)) { 
                                    $query_pn -> execute(array(
                                        ':id' => $product["store_id"]
                                    ));
                                    $store_product = $query_pn -> fetch(PDO::FETCH_ASSOC);
                                    
                                    ?>
                                    <div class="user">
                                        <div class="user-id store-id">
                                            <p><?= $product["product_id"] ?></p>
                                        </div>
                                        <div class="user-email-name store-name">
                                            <div class="name">
                                                <p><?= $product["product_name"] ?></p>
                                            </div>
                                            <div class="email store-own">
                                                <p><?= $store_product["store_name"] ?> [<a href="https://nintaisquare.com/store/?store_id=<?= $product["store_id"] ?>" target="_blank"><?= $store_product["store_id"] ?></a>]</p>
                                            </div>
                                        </div>
                                        <div class="actions">
                                            <a href="https://nintaisquare.com/product/?product_id=<?= $product["product_id"] ?>" target="_blank">
                                                <div class="details-user product">
                                                    <p>Ver producto</p>
                                                </div>
                                            </a>
                                            <a href="index.php?products-list&delete-product=<?= $product["product_id"] ?>-<?= $product["store_id"] ?>">
                                                <div class="delete-user product">
                                                    <p>Eliminar</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="panel-container">
                    <div class="title-container">
                        <h2 class="title"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" --darkreader-inline-fill: #e8e6e3;" data-darkreader-inline-fill=""><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm5 2h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm1-6h4v4h-4V5zM3 20a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6zm2-5h4v4H5v-4zm8 5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6zm2-5h4v4h-4v-4z"></path></svg>Panel de control.</h2>
                        <?php
                            $query = $pdo -> query("SELECT id_report FROM reports");
                            $count = $query -> rowCount();

                            if ($count >= 1) { ?>
                                <a href="reports/" class="link-reports">Ver <?= $count; ?> reportes<i class='fa-solid fa-arrow-right'></i></a>
                            <?php }
                        ?>
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