<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    noset();
    $user = new user;

    if (is_object($user)) {
        //Validando existencia.
        $sql = "SELECT count(*) `exists` FROM users WHERE user_id = :id";
        $query = $pdo -> prepare($sql);
        $query -> execute(Array(
            ':id' => htmlentities($_GET["user_id"])
        ));
        $query = $query -> fetch(PDO::FETCH_ASSOC);

        if ($query["exists"] == 0) {
            header("Location: ../");
            return;
        } else {
            $sql = "SELECT * FROM users WHERE user_id = :id";
            $query = $pdo -> prepare($sql);
            $query -> execute(Array(
                ':id' => htmlentities($_GET["user_id"])
            ));
            $user_data = $query -> fetch(PDO::FETCH_ASSOC);

            if ($user_data["admin"] == 1) {
                $user_data["admin"] = true;
            } else {
                $user_data["admin"] = false;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user_data["name"] ?> | NintaiSquare</title>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../sources/assets/styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?= require_once("../sources/templates/header/header-login.php"); ?>
    <div class="profile-user-container">
        <div class="profile-user-container-title">
            <h1 class="title"><?= $user -> own_profile() ? "Mi perfil" : "Perfil"?></h1>
        </div>
        <div class="profile-user-content">
            <div class="profile-user-pic">
                <img src="../sources/assets/img/user-icon.svg" alt="User-icon">
            </div>
            <div class="profile-user-data">
                <h4 class="profile-user-name"><?= $user_data["name"]; ?></h4>
                <div class="profile-user-details">
                    <p class="details-text">Tiendas registradas: <!-- En proceso... --></p>
                </div>
            </div>
            <?php
                if ($user_data["admin"] == 1) { ?>
                    <div class="user-rol"><p class="admin-text">Administrador</p></div>
                <?php } else { ?>
                    <div class="user-rol"><p class="user-text">Usuario</p></div>
                <?php }
            ?>
            <?php
                if ($user -> own_profile()) { ?>
                    <div class="profile-user-action">
                        <div class="link"><a href="https://nintaisquare.com/user/settings.php"><i class="fa-solid fa-gear"></i>Ajustes</a></div>
                    </div>
                <?php }
            ?>
        </div>
        <div class="user-stores-content">
            <h3 class="h3-title"><?= $user -> own_profile() ? "Mis tiendas" : "Tiendas"?></h3>
            <!-- En proceso... -->
        </div>
    </div>
    <?php require_once("../sources/templates/footer/footer.php");?>
</body>
</html>