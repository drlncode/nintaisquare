<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    set();

    if (isset($_POST["name-r"]) && isset($_POST["email-r"]) && isset($_POST["password-r"])) {
        if (empty($_POST["name-r"]) || empty($_POST["email-r"]) || empty($_POST["password-r"])) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Rellene todos los campos.</span>";
            header("Location: https://nintaisquare.com/user/signup.php");
            return;
        } elseif (!is_numeric($_POST["name-r"])) {
            for ($i = 0; $i < strlen($_POST["name-r"]); $i++) {
                if (is_numeric($_POST["name-r"][$i])) {
                    $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un nombre válido.</span>";
                    header("Location: https://nintaisquare.com/user/signup.php");
                    exit;
                }
            } 
        } elseif (!filter_var($_POST["email-r"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un correo válido.</span>";
            header("Location: https://nintaisquare.com/user/signup.php");
            return;
        } else {
            $query = $pdo -> prepare("SELECT count(email) email FROM users WHERE email = :em");
            $query -> execute(array(
                ':em' => htmlentities($_POST["email-r"])
            ));
            $email = $query -> fetch(PDO::FETCH_ASSOC);

            if ($email["email"] == 1) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Este correo ya está registrado.</span>";
                header("Location: https://nintaisquare.com/user/signup.php");
                return;
            } else {
                $sql = "INSERT INTO users(name, email, password, admin) VALUES (:nm, :em, :pw, :ad);";
                $query = $pdo -> prepare($sql);
                $query -> execute(array(
                    ':nm' => htmlentities($_POST["name-r"]),
                    ':em' => htmlentities($_POST["email-r"]),
                    ':pw' => hash("MD5", $_POST["password-r"]),
                    ':ad' => 0
                ));
                $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>Registro exitoso!</span>";
                header("Location: https://nintaisquare.com/user/signin.php");
                return;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/styles-form.css">
    <link rel="stylesheet" href="../sources/assets/styles/no-responsive.css">
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
</head>
<body>
    <?php
        require_once("../sources/templates/no-resposive/index.php");
    ?>
    <div class="container">
        <div class="form-container-1">
            <div class="form-content-1">
                <div class="content">
                    <h1 class="title">Regístrarse</h1>
                    <p class="text">Regístrese para acceder a las herramientas y múltiples recursos que le ofrecemos en NintaiSquare para impulsar su negocio. Asegúrese de introducir correctamente sus datos.</p>
                </div>
            </div>
        </div>
        <div class="form-container-2">
            <div class="form-header">
                <a href="https://nintaisquare.com"><img src="../sources/assets/img/logo.png" alt="NintaiSquare" title="NintaiSquare"></a>
            </div>
            <form method="post" class="form-content">
                <?php
                    if (isset($_SESSION["msg"])) {
                        echo $_SESSION["msg"];
                        unset($_SESSION["msg"]);
                    }
                ?>
                <label for="name">
                    Nombre completo:<input type="name" name="name-r" id="name" placeholder="Ingrese su nombre completo">
                </label>
                <label for="email">
                    Correo:<input type="email" name="email-r" id="email" placeholder="Ingrese su correo">
                </label>
                <label for="password">
                    Contraseña:<input type="password" name="password-r" id="password" placeholder="Ingrese su contraseña">
                </label>
                <div class="lost-password">
                    <p class="lost-p">Ya tienes una cuenta? <a href="https://nintaisquare.com/user/signin.php" class="link"><i class="fa-solid fa-right-to-bracket"></i>Iniciar sesión</a></p>
                </div>
                <div class="form-footer">
                    <button type="submit" class="boton">Entrar</button>
                    <a href="https://nintaisquare.com/" class="boton-link">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>