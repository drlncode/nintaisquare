<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    noset();

    if (!isset($_GET["personal"]) && !isset($_GET["danger-zone"]) && !isset($_GET["change-data"])) {
        header("Location: " . $_SERVER["REQUEST_URI"] . "?personal");
        exit;
    }

    //Datos del usuario.
    $query = $pdo -> prepare("SELECT user_id, name, email FROM users WHERE user_id = :id");
    $query -> execute(array(
        ':id' => $_SESSION["USER_AUTH"]["user_id"]
    ));
    $n_e = $query -> fetch(PDO::FETCH_ASSOC);

    $query = $pdo -> prepare("SELECT COUNT(*)")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes | NintaiSquare</title>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/user-settings.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require_once("../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo($_SESSION["msg"]);
                unset($_SESSION["msg"]);
            }
        ?>
        <div class="settings-content">
            <div class="settings-nav">
                <nav class="navbar">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-gear"></i>Ajustes</h2>
                    </div>
                    <div class="navbar-options">
                        <a href="settings.php?personal" class="link personal" style="background-color:<?= isset($_GET['personal']) ? 'var(--border-color);color:var(--background-color)' : 'unset' ?>;"><i class="fa-solid fa-user-lock"></i>Datos personales</a>
                        <a href="settings.php?change-data" class="link change-data" style="background-color:<?= isset($_GET['change-data']) ? 'var(--border-color);color:var(--background-color)' : 'unset' ?>;"><i class="fa-solid fa-user-pen"></i>Cambiar datos</a>
                        <a href="settings.php?danger-zone" class="link danger-zone" style="background-color:<?= isset($_GET['danger-zone']) ? 'var(--border-color);color:var(--background-color)' : 'unset' ?>;"><i class="fa-solid fa-triangle-exclamation"></i>Zona de riesgo.</a> 
                    </div>
                </nav>
            </div>
            <div class="settings-options">
                <?php
                    if (isset($_GET["personal"])) { ?>
                        <div class="settings my-data">
                            <div class="header-info"><span class="info"><i class="fa-solid fa-circle-info"></i>Recuerda no compartir tus datos personales con nadie.</span></div>
                            <div class="user-info">
                                <div class="vanished">
                                    <div class="user-content">
                                        <div class="header"><h3 class="title">Mi ID.</h3></div>
                                        <div class="content"><span class="u-info">- <?= $n_e["user_id"] ?></span></div>
                                    </div>
                                    <div class="user-content">
                                        <div class="header"><h3 class="title">Mi nombre.</h3></div>
                                        <div class="content"><span class="u-info">- <?= $n_e["name"] ?></span></div>
                                    </div>
                                </div>
                                <div class="user-content">
                                    <div class="header"><h3 class="title">Mi correo.</h3></div>
                                    <div class="content"><span class="u-info">- <?= $n_e["email"] ?></span></div>
                                </div>
                                <div class="user-statistics">
                                    <div class="user-content">
                                        <div class="header"><h3 class="title">Cantidad de tiendas registradas.</h3></div>
                                        <div class="content"><span class="u-info">- <?= $n_e["email"] ?></span></div>
                                    </div>
                                    <div class="user-content">
                                        <div class="header"><h3 class="title">Cantidad de productos registradas.</h3></div>
                                        <div class="content"><span class="u-info">- <?= $n_e["email"] ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } elseif(isset($_GET["change-data"])) { ?>
                        <div class="settings settings-personal">
                            <form class="content-form" method="post" class="content-name">
                                <h3 class="title">Cambiar nombre</h3>
                                <div class="inputs">
                                    <div class="input-email">
                                        <input type="email" name="change-name" class="text" placeholder="Introduzca su nuevo nombre...">
                                    </div>
                                    <div class="confirm-changes">
                                        <input type="password" name="password-verify" placeholder="Introduzca su contraseña actual...">
                                        <button type="submit">Confirmar</button>
                                    </div>
                                </div>
                            </form>
                            <form class="content-form" method="post" class="content-email">
                                <h3 class="title">Cambiar dirección de correo</h3>
                                <div class="inputs">
                                    <div class="input-email">
                                        <input type="email" name="change-email" class="email" placeholder="Introduzca su nuevo email...">
                                    </div>
                                    <div class="confirm-changes">
                                        <input type="password" name="password-verify" placeholder="Introduzca su contraseña actual...">
                                        <button type="submit">Confirmar</button>
                                    </div>
                                </div>
                            </form>
                            <form class="content-form" method="post" class="content-password">
                                <h3 class="title">Cambiar contraseña</h3>
                                <div class="inputs">
                                    <div class="input-password">
                                        <input type="password" name="change-pw-1" placeholder="Introduzca su nueva contraseña...">
                                        <input type="password" name="change-pw-2" placeholder="Introduzcala aquí de nuevo...">
                                    </div>
                                    <div class="confirm-changes">
                                        <input type="password" name="password-verify" placeholder="Introduzca su contrasñea actual...">
                                        <button type="submit">Confirmar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="settings settings-danger-zone">
                            <div class="header-info"><span class="info"><i class="fa-solid fa-triangle-exclamation"></i>Recuerda que todo lo que hagas aqui se aplicará de forma definitiva.</span></div>
                            <div class="options">
                                <div class="option">
                                    <div class="header"><h3 class="title">Borrar todas mis tiendas registradas.</h3></div>
                                    <div class="content"><a href="<?= $_SERVER["REQUEST_URI"]; ?>&dlt-all-stores=<?= $_SESSION["USER_AUTH"]["user_id"]; ?>" class="action"><i class="fa-solid fa-trash-can"></i>Borrar</a></div>
                                </div>
                                <div class="option">
                                    <div class="header"><h3 class="title">Borrar todos mis productos registrados.</h3></div>
                                    <div class="content"><a href="<?= $_SERVER["REQUEST_URI"] ?>&dlt-all-products=<?= $_SESSION["USER_AUTH"]["user_id"]; ?>" class="action"><i class="fa-solid fa-trash-can"></i>Borrar</a></div>
                                </div>
                                <div class="option">
                                    <div class="header"><h3 class="title">Borrar mi cuenta</h3></div>
                                    <div class="content"><a href="delete/?dlt-usr=<?= $_SESSION["USER_AUTH"]["user_id"]; ?>" class="action"><i class="fa-solid fa-trash-can"></i>Borrar</a></div>
                                </div>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
</body>
</html>