<?php
    session_start();
    require_once("../../sources/controller/pdo.php");
    require_once("../../sources/controller/funciones.php");
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
            <form action="" method="post" class="report-form-content">
                <label for="type"><p class="caption">Selecciona el problema</p>
                    <select name="type" id="type" autofocus="autofocus">
                        <option value="">Seleccione</option><hr class="new">
                        <option value="e-d">Error de diseño</option>
                        <option value="e-r">Error al registrar</option>
                        <option value="e-e">Error al eliminar</option>
                        <option value="e-o">Otro</option>
                    </select>
                </label>
                <div class="divisor"></div>
                <label for="e-desc"><p class="caption">Háblanos sobre el problema</p>
                    <textarea name="e-desc" id="e-desc" placeholder="Describe aquí..." style="resize: none;"></textarea>
                </label>
                <div class="divisor"></div>
                <label for="e-img"><p class="caption">Adjuntar una imagen del problema [Max: 2MB / Formato: .png, .jpg] <b>(Opcional)</b></p>
                    <input type="file" name="e-img" id="e-img" accept=".png, .jpg, .jpeg">
                </label>
                <div class="divisor"></div>
                <?php
                    if (!isset($_SESSION["USER_AUTH"])) { ?>
                        <label for="e-r-email"><p class="caption">Ingrese su correo elétronico. <span class="diff">(En este recibirá la respuesta a su reporte.)</span></p>
                            <input type="email" name="e-r-email" id="e-r-email" placeholder="Su correo...">
                        </label>
                    <?php } else { ?>
                        <span class="saved-email">Le enviaremos la respuesta de su reporte al correo asociado con su cuenta: <b><?= $_SESSION["USER_AUTH"]["email"] ?></b>.</span>
                    <?php }
                ?>
                <div class="divisor"></div>
                <div class="actions">
                    <button type="submit" class="btn submit">Enviar</button>
                    <a href="../" class="btn cancel">Cancelar</a>
                </div>
            </form>
            <div class="content-github-link">
                <a href="https://github.com/Darlin-code/nintaisquare/issues/new" class="go-github" target="_blank">Reportar directamente en GitHub<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <?php
            require_once("../../sources/templates/support/support-footer.php");
        ?>
    </div>
</body>
</html>