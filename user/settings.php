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

    if (isset($_POST["change-name"]) && !empty($_POST["change-name"])) {
        if(!empty($_POST["password-verify"])) {
            for ($i = 0; $i < strlen($_POST["change-name"]); $i++) {
                if (is_numeric($_POST["change-name"][$i])) {
                    $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un nombre válido</span>";
                    header("Location: settings.php?change-data");
                    exit;
                }
            }
            $pw = hash("MD5", $_POST["password-verify"]);
            if ($pw !== $_SESSION["USER_AUTH"]["user_pw"]) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Contraseña incorrecta.</span>";
                header("Location: settings.php?change-data");
                exit;
            } else {
                $query = $pdo -> prepare("UPDATE `users` SET `name` = :cm WHERE `user_id` = :id;");
                $query -> execute(array(
                    ':cm' => htmlentities($_POST["change-name"]),
                    ':id' => $_SESSION["USER_AUTH"]["user_id"]
                ));

                $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Nombre modificado con éxito!</span>";
                header("Location: settings.php?personal");
                exit;
            }
        } else {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese su contraseña actual.</span>";
            header("Location: settings.php?change-data");
            exit;
        }
    } elseif (isset($_POST["change-name"]) && empty($_POST["change-name"])) {
        $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese algún valor.</span>";
        header("Location: settings.php?change-data");
        exit;
    }
    
    if (isset($_POST["change-email"]) && !empty($_POST["change-email"])) {
        if(!empty($_POST["password-verify"])) {
            $pw = hash("MD5", $_POST["password-verify"]);
            if (!filter_var($_POST["change-email"], FILTER_VALIDATE_EMAIL)) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un email válido.</span>";
                header("Location: settings.php?change-data");
                exit;
            } elseif ($pw !== $_SESSION["USER_AUTH"]["user_pw"]) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Contraseña incorrecta.</span>";
                header("Location: settings.php?change-data");
                exit;   
            } else {
                $query = $pdo -> prepare("UPDATE `users` SET `email` = :em WHERE `user_id` = :id;");
                $query -> execute(array(
                    ':em' => htmlentities($_POST["change-email"]),
                    ':id' => $_SESSION["USER_AUTH"]["user_id"]
                ));

                $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Correo modificado con éxito!</span>";
                header("Location: settings.php?personal");
                exit;
            }
        } else {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese su contraseña actual.</span>";
            header("Location: settings.php?change-data");
            exit;
        }
    } elseif (isset($_POST["change-email"]) && empty($_POST["change-email"])) {
        $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese algún valor.</span>";
        header("Location: settings.php?change-data");
        exit;
    }

    if (isset($_POST["change-pw-1"]) && !empty($_POST["change-pw-1"]) && !empty($_POST["change-pw-2"])) {
        if(!empty($_POST["password-verify"])) {
            $pw = hash("MD5", $_POST["password-verify"]);
            $n_pw = hash("MD5", $_POST["change-pw-1"]);
            if ($_POST["change-pw-1"] !== $_POST["change-pw-2"]) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Las nuevas contraseñas no coinciden.</span>";
                header("Location: settings.php?change-data");
                exit;
            } elseif ($pw !== $_SESSION["USER_AUTH"]["user_pw"]) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Contraseña incorrecta.</span>";
                header("Location: settings.php?change-data");
                exit;
            } elseif ($n_pw == $_SESSION["USER_AUTH"]["user_pw"]) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>La contraseña debe ser diferente a la actual.</span>";
                header("Location: settings.php?change-data");
                exit;
            } else {
                $query = $pdo -> prepare("UPDATE `users` SET `password` = :pw WHERE `user_id` = :id;");
                $query -> execute(array(
                    ':pw' => hash("MD5", $_POST["change-pw-1"]),
                    ':id' => $_SESSION["USER_AUTH"]["user_id"]
                ));

                $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Contraseña modificada con éxito!</span>";
                header("Location: settings.php?personal");
                exit;
            }
        } else {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese su contraseña actual.</span>";
            header("Location: settings.php?change-data");
            exit;
        }
    } elseif (isset($_POST["change-pw-1"]) && empty($_POST["change-pw-1"]) && empty($_POST["change-pw-2"])) {
        $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese algún valor.</span>";
        header("Location: settings.php?change-data");
        exit;
    }
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
                        <a href="settings.php?personal" class="link personal"><i class="fa-solid fa-user-lock"></i>Datos personales</a>
                        <a href="settings.php?change-data" class="link change-data"><i class="fa-solid fa-user-pen"></i>Cambiar datos</a>
                        <a href="settings.php?danger-zone" class="link danger-zone"><i class="fa-solid fa-triangle-exclamation"></i>Zona de riesgo.</a> 
                    </div>
                    <style>
                        .link {
                            text-decoration: none;
                            width: 170px;
                            display: flex;
                            align-items: center;
                            gap: 5px;
                            padding: 10px;
                            color: var(--border-color);
                            border-radius: 30px;
                            font-size: 0.8em;
                            padding-top: 9.5px;
                            padding-left: 15px;
                            transition: all 0.2s;
                        }

                        .link:hover {
                            background-color: #ebebeb;
                            box-shadow: 2px 1px 10px 2px rgba(20, 20, 20, 0.20);
                        }

                        <?php
                            if (isset($_GET['personal'])) { ?>
                                .personal {
                                    background-color: var(--border-color);
                                    color: var(--background-color);
                                    box-shadow: 2px 1px 10px 2px rgba(20, 20, 20, 0.20);
                                }

                                .personal:hover {
                                    background-color: var(--border-color);
                                    color: var(--background-color);
                                }
                            <?php } elseif (isset($_GET["change-data"])) { ?>
                                .change-data {
                                    background-color: var(--border-color);
                                    color: var(--background-color);
                                    box-shadow: 2px 1px 10px 2px rgba(20, 20, 20, 0.20);
                                }

                                .change-data:hover {
                                    background-color: var(--border-color);
                                    color: var(--background-color);
                                }
                            <?php } else { ?>
                                .danger-zone {
                                    background-color: var(--border-color);
                                    color: var(--background-color);
                                    box-shadow: 2px 1px 10px 2px rgba(20, 20, 20, 0.20);
                                }

                                .danger-zone:hover {
                                    background-color: var(--border-color);
                                    color: var(--background-color);
                                }
                            <?php }
                        ?>
                    </style>
                </nav>
            </div>
            <div class="settings-options">
                <?php
                    if (isset($_GET["personal"])) { ?>
                        <div class="settings my-data">
                            <div class="header-info"><span class="info"><i class="fa-solid fa-circle-info"></i>Recuerda no compartir tus datos personales con nadie.</span></div>
                            <h2 class="main-title">Datos de usuario.</h2>
                            <div class="user-info">
                                <div class="user-content">
                                    <div class="header"><h3 class="title">Nombre</h3></div>
                                    <span class="u-info"><a href="settings.php?change-data"><i class="fa-solid fa-pen-to-square"></i></a><?= $n_e["name"] ?> <id><?= $n_e["user_id"] ?></id></span>
                                </div>
                                <div class="user-content">
                                    <div class="header"><h3 class="title">Correo</h3></div>
                                    <span class="u-info"><a href="settings.php?change-data"><i class="fa-solid fa-pen-to-square"></i></a><?= $n_e["email"] ?></span>
                                </div>
                                <div class="user-content">
                                    <div class="header"><h3 class="title">Contraseña (Encryptada)</h3></div>
                                    <span class="u-info"><a href="settings.php?change-data"><i class="fa-solid fa-pen-to-square"></i></a><?php
                                        $str = strlen($_SESSION["USER_AUTH"]["user_pw"]);
                                        for ($i = 0; $i < $str; $i++) {
                                            echo "•";
                                        }
                                    ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } elseif(isset($_GET["change-data"])) { ?>
                        <div class="settings settings-personal">
                            <form class="content-form" method="post" class="content-name">
                                <h3 class="title">Cambiar nombre</h3>
                                <div class="inputs">
                                    <div class="input-email">
                                        <input type="text" name="change-name" class="text" placeholder="Introduzca su nuevo nombre...">
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