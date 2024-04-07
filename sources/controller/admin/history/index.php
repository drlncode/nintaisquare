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
    }
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
            <div class="history-register-container">
                <?php
                    $query = $pdo -> query("SELECT * FROM history;");
                    $query_n = $pdo -> prepare("SELECT name FROM users WHERE user_id = :id");

                    while ($history = $query -> fetch(PDO::FETCH_ASSOC)) {
                        $query_n -> execute(array(
                            ':id' => $history["by"]
                        ));
                        $pre_name = $query_n -> fetch(PDO::FETCH_ASSOC);
                        $name = explode(" ", $pre_name["name"]);
                        
                        if ($history["status"] == "accepted" && $history["category"] == "store") { ?>
                            <div class="history-register accepted">
                                <div class="date"><span><?= $history["date"] ?></span></div>
                                <div class="info">
                                    <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] aprobó una tienda del usuario con el ID: <a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["of"] ?>" target="_blank"><?= $history["of"] ?></a></span>
                                </div>
                            </div>
                        <?php } elseif ($history["status"] == "accepted" && $history["category"] == "product") { ?>
                            <div class="history-register accepted">
                                <div class="date"><span><?= $history["date"] ?></span></div>
                                <div class="info">
                                    <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] aprobó un producto de la tienda con el ID: <a href="https://nintaisquare.com/store/?store_id=<?= $history["of"] ?>"><?= $history["of"] ?></a></span>
                                </div>
                            </div>
                        <?php } elseif ($history["status"] == "denied" && $history["category"] == "store") { ?>
                            <div class="history-register denied">
                                <div class="date"><span><?= $history["date"] ?></span></div>
                                <div class="info">
                                    <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] rechazó una tienda del usuario con el ID: <a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["of"] ?>" target="_blank"><?= $history["of"] ?></a></span>
                                </div>
                            </div>
                        <?php } elseif ($history["status"] == "denied" && $history["category"] == "product") { ?>
                            <div class="history-register denied">
                                <div class="date"><span><?= $history["date"] ?></span></div>
                                <div class="info">
                                    <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] rechazó un producto de la tienda con el ID: <a href="https://nintaisquare.com/store/?store_id=<?= $history["of"] ?>"><?= $history["of"] ?></a></span>
                                </div>
                            </div>
                        <?php } elseif ($history["status"] == "deleted" && $history["category"] == "store") {
                            if ($history["by"] == $history["of"]) { ?>
                                <div class="history-register denied">
                                    <div class="date"><span><?= $history["date"] ?></span></div>
                                    <div class="info">
                                        <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] eliminó su tienda con el ID: <?= $history["of"] ?></span>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="history-register denied">
                                    <div class="date"><span><?= $history["date"] ?></span></div>
                                    <div class="info">
                                        <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] eliminó una tienda con el ID: <?= $history["of"] ?></span>
                                    </div>
                                </div>
                            <?php }
                        } elseif ($history["status"] == "deleted_all") {
                            if ($history["category"] == "store") { ?>
                                <div class="history-register denied">
                                    <div class="date"><span><?= $history["date"] ?></span></div>
                                    <div class="info">
                                        <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] eliminó todas sus tiendas.</span>
                                    </div>
                                </div>
                            <?php } elseif ($history["category"] == "product") { ?>
                                <div class="history-register denied">
                                    <div class="date"><span><?= $history["date"] ?></span></div>
                                    <div class="info">
                                        <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] eliminó todos los productos de su tienda con el ID: <a href="https://nintaisquare.com/store/?store_id=<?= $history["of"] ?>" target="_blank"><?= $history["of"] ?></a></span>
                                    </div>
                                </div>
                            <?php }
                        } elseif ($history["status"] == "deleted" && $history["category"] == "user") { ?>
                            <div class="history-register denied">
                                <div class="date"><span><?= $history["date"] ?></span></div>
                                <div class="info">
                                    <span><?= $name[0] ?>[<a href="https://nintaisquare.com/user/profile.php?user_id=<?= $history["by"] ?>" target="_blank"><?= $history["by"] ?></a>] eliminó a un usuario con el ID: <?= $history["of"] ?></span>
                                </div>
                            </div>
                        <?php }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>