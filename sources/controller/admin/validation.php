<?php
    session_start();
    require_once("../funciones.php");
    $admin = new admin_validation; // Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirmed();

    if (isset($_POST["key"])) {
        if (empty($_POST["key"])){
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Rellene el campo.</span>";
            header("Location: validation.php");
            return;
        } else {
            if (hash("MD5", $_POST["key"]) === $_SESSION["USER_AUTH"]["user_pw"]) {
                $_SESSION["USER_AUTH"]["admin_confirm"] = true;
                $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-exclamation'></i>Bienvenido.</span>";
                header("Location: ../admin/");
                return;
            } else {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Contraseña incorrecta.</span>";
                header("Location: validation.php");
                return;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de administrador | NintaiSquare</title>
    <link rel="stylesheet" href="../../assets/styles/root.css">
    <link rel="stylesheet" href="../../assets/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="container-img">
            <img src="../../assets/img/logo.png" alt="NintaiSquare" title="NintaiSquare">
        </div>
        <form action="" class="form-container" method="POST">
            <?php
                if (isset($_SESSION["msg"])) {
                    echo $_SESSION["msg"];
                    unset($_SESSION["msg"]);
                }
            ?>
            <label for="">
                <i class="fa-solid fa-key"></i>Introduzca su contraseña: <input type="password" name="key" id="" class="key">
            </label>
            <button type="submit">Confirmar</button>
        </form>
    </div>
</body>
</html>