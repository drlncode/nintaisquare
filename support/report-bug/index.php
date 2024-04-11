<?php
    session_start();
    //require_once("../../sources/controller/pdo.php");
    //require_once("../../sources/controller/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contácto NintaiSquare">
    <title>Reportar error | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../../sources/assets/styles/support.css">
    <link rel="icon" type="image/x-icon" href="../../sources/assets/img/favicon-support.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }

            require_once("../../sources/templates/support/support-header.php");
        ?>
        <div class="report-container">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-bug"></i>Reportar un error</h2>
            </div>
            <form action="" method="post" class="report-content">
                <label for="type">Selecciona el problema
                    <select name="type" id="type" style="text-align: center;">
                        <option value="">Seleccione</option><hr>
                        <option value="e-d">Error de diseño</option>
                        <option value="e-r">Error al registrar</option>
                        <option value="e-e">Error al eliminar</option>
                        <option value="e-o">Otro</option>
                    </select>
                </label>
                <label for="e-desc">Háblanos sobre el problema
                    <textarea name="e-desc" id="e-desc" cols="55" rows="10" placeholder="Describe aquí..." style="resize: none;"></textarea>
                </label>
                <label for="e-img">Adjuntar una imagen del problema <b>(Opcional)</b>
                    <input type="file" name="e-img" id="e-img">
                </label>
                <?php
                    if (!isset($_SESSION["USER_AUTH"])) { ?>
                        <label for="e-r-email">Ingrese su correo elétronico, en este recibirá la respuesta a su reporte.
                            <input type="email" name="e-r-email" id="e-r-email" placeholder="Su correo...">
                        </label>
                    <?php } else { ?>
                        <span class="saved-email">Le enviaremos la respuesta de su reporte al correo asociado con su cuenta: <b><?= $_SESSION["USER_AUTH"]["email"] ?></b>.</span>
                    <?php }
                ?>
            </form>
        </div>
        <?php
            require_once("../../sources/templates/support/support-footer.php");
        ?>
    </div>
</body>
</html>