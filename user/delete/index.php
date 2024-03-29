<?php
    session_start();
    require_once("../../sources/controller/pdo.php");
    require_once("../../sources/controller/funciones.php");
    noset();
    date_default_timezone_set("America/Santo_Domingo");
    $date = getdate();

    if (isset($_GET["dlt-str"]) && !empty($_GET["dlt-str"])) {
        $query = $pdo -> prepare("SELECT store_id, store_name, user_id FROM val_stores WHERE store_id = :id;");
        $query -> execute(array(
            ':id' => htmlentities($_GET["dlt-str"])
        ));

        if ($query -> rowCount() == 1) {
            $store = $query -> fetch(PDO::FETCH_ASSOC);
            if (isset($_GET["confirm"])) {
                if ($store["user_id"] != $_SESSION["USER_AUTH"]["user_id"]) {
                    session_destroy();
                    header("Location: https://nintaisquare.com/");
                    exit;
                } else {
                    $query_del = $pdo -> prepare("DELETE FROM val_stores WHERE store_id = :id"); 
                    $query_del -> execute(array(
                        ':id' => $store["store_id"]
                    ));
        
                    $query_del = $pdo -> prepare("DELETE FROM val_products WHERE store_id = :id"); 
                    $query_del -> execute(array(
                        ':id' => $store["store_id"]
                    ));

                    $query_his = $pdo -> prepare("INSERT INTO history (`status`, `by`, `category`, `of`, `date`) VALUES (:st, :by, :cy, :of, :dt)");
                    $query_his -> execute(array(
                        ':st' => "deleted",
                        ':by' => $_SESSION["USER_AUTH"]["user_id"],
                        ':cy' => "store",
                        ':of' => $_SESSION["USER_AUTH"]["user_id"],
                        ':dt' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
                    ));

                    header("Location: ../mystores.php");
                    exit;
                }
            }
        } else {
            header("Location: ../mystores.php");
            exit;
        }
    } elseif (isset($_GET["dlt-usr"]) && !empty($_GET["dlt-usr"])) {

    } else {
        header("Location: https://nintaisquare.com/");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar <?= isset($_GET["dlt-str"]) ? "tienda" : "cuenta" ?> | NintaiSquare</title>
    <link rel="icon" type="image/x-icon" href="../../sources/assets/img/favicon.png">
    <link rel="stylesheet" href="../../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../../sources/assets/styles/user-store-delete.css">
    <link rel="stylesheet" href="../../sources/assets/styles/no-responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require_once("../../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <div class="content">
            <div class="header-content">
                <img src="https://nintaisquare.com/sources/assets/img/logo.png" alt="NintaiSquare Logo">
            </div>
            <?php
                if (isset($_GET["dlt-str"]) && !empty($_GET["dlt-str"])) { ?>
                    <div class="body-content">
                        <div class="body-content-header">
                            <h2 class="title">¿Estás seguro que quieres borrar esta tienda: <?= $store["store_name"] ?>?</h2>
                            <span class="info">Ten cuenta que al borrar esta tienda se perderán todos los datos y se borrará todo lo que esté asociado a ella.</span>
                        </div>
                        <div class="options">
                            <a class="btn go" href="<?= $_SERVER["REQUEST_URI"] ?>&confirm">Eliminar</a>
                            <a class="btn out" href="../mystores.php">Cancelar</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="body-content">
                        <div class="body-content-header">
                            <h2 class="title">¿<?= $_SESSION["USER_AUTH"]["name_parts"][0] ?>, estás seguro que quieres eliminar tu cuenta?</h2>
                            <span class="info">Ten cuenta que al borrar tu cuenta se perderán todos tus datos y se borrará todo lo que esté asociado a tu cuenta.</span>
                        </div>
                        <div class="options">
                            <a href="<?= $_SERVER["REQUEST_URI"] ?>&confirm">Eliminar</a>
                            <a href="../settings.php">Cancelar</a>
                        </div>
                    </div>
                <?php }
            ?>
        </div>
    </div>
</body>
</html>