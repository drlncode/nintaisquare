<?php
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/validations.php");
    //Validación de los datos
    validate_signup($pdo);
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
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
</head>
<body>
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
                <a href="http://localhost/nintaisquare/"><img src="http://localhost/nintaisquare/sources/assets/img/logo.png" alt="NintaiSquare" title="NintaiSquare"></a>
            </div>
            <form method="post" class="form-content">
                <?php
                    if (isset($_SESSION["msg"])) {
                        echo $_SESSION["msg"];
                        unset($_SESSION["msg"]);
                    }
                ?>
                <label for="name">
                    Nombre completo:<input type="name" name="name" id="name" placeholder="Ingrese su nombre completo">
                </label>
                <label for="email">
                    Correo:<input type="email" name="email" id="email" placeholder="Ingrese su correo">
                </label>
                <label for="password">
                    Contraseña:<input type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                </label>
                <div class="lost-password">
                    <p class="lost-p">Ya tienes una cuenta? <a href="http://localhost/nintaisquare/user/signin.php" class="link"><i class="fa-solid fa-right-to-bracket"></i>Iniciar sesión</a></p>
                </div>
                <div class="form-footer">
                    <button type="submit" class="boton">Entrar</button>
                    <a href="http://localhost/nintaisquare/" class="boton-link">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>