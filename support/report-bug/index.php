<?php
    session_start();
    require_once("../../sources/controller/pdo.php");
    date_default_timezone_set("America/Santo_Domingo");
    $date = getdate();

    if (isset($_POST["e-category"])) {
        if (empty($_POST["e-category"]) || empty($_POST["e-desc"])) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Rellene todos los campos.</span>";
            header("Location: " . $_SERVER["REQUEST_URI"] . "");
            exit;
        }
        if ($_FILES["e-img"]["size"] != 0) {
            if ($_FILES["e-img"]["size"] / 1024 > 2048) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>La imagen excede el limite de 2MB.</span>";
                header("Location: " . $_SERVER["REQUEST_URI"] . "");
                exit;
            } elseif ($_FILES["e-img"]["type"] !== "image/png" && $_FILES["e-img"]["type"] !== "image/jpg" && $_FILES["e-img"]["type"] !== "image/jpeg") {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Seleccione un formato de imagen válido.</span>";
                header("Location: " . $_SERVER["REQUEST_URI"] . "");
                exit;
            }
        } 
        if (strlen($_POST["e-desc"]) < 100) {
            $_SESSION["cache"] = $_POST["e-desc"];
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>No cumple con el mínimo de carácteres.</span>";
            header("Location: " . $_SERVER["REQUEST_URI"] . "");
            exit;
        } 
        if (strlen($_POST["e-desc"]) > 512) {
            $_SESSION["cache"] = $_POST["e-desc"];
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Se excede con el máximo de carácteres.</span>";
            header("Location: " . $_SERVER["REQUEST_URI"] . "");
            exit;
        } 
        if (isset($_POST["e-r-email"])) {
            if (empty($_POST["e-r-email"])) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un correo.</span>";
                header("Location: " . $_SERVER["REQUEST_URI"] . "");
                exit;
            } elseif (!filter_var($_POST["e-r-email"], FILTER_VALIDATE_EMAIL)) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un correo válido.</span>";
                header("Location: " . $_SERVER["REQUEST_URI"] . "");
                exit;
            }
        }

        $query = $pdo -> prepare("INSERT INTO reports (category_report, desc_report, img_report, by_report, date_report) VALUES (:cr, :dr, :ir, :br, :dtr)");
        $query -> execute(array(
            ':cr' => htmlentities($_POST["e-category"]),
            ':dr' => htmlentities($_POST["e-desc"]),
            ':ir' => $_FILES["e-img"]["size"] == 0 ? null : base64_encode(file_get_contents($_FILES["e-img"]["tmp_name"])),
            ':br' => isset($_SESSION["USER_AUTH"]) ? $_SESSION["USER_AUTH"]["email"] : htmlentities($_POST["e-r-email"]),
            ':dtr' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
        ));

        $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-exclamation'></i>Reporte realizado con éxito!</span>";
        header("Location: " . $_SERVER["REQUEST_URI"] . "");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reportar NintaiSquare">
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
            <form action="" method="post" class="report-form-content" enctype="multipart/form-data">
                <label for="e-category"><p class="caption">Selecciona el problema</p>
                    <select name="e-category" id="e-category" autofocus="autofocus">
                        <option value="">Seleccione</option><hr class="new">
                        <option value="e-d">Error de diseño</option>
                        <option value="e-r">Error al registrar</option>
                        <option value="e-e">Error al eliminar</option>
                        <option value="e-o">Otro</option>
                    </select>
                </label>
                <div class="divisor"></div>
                <label for="e-desc"><p class="caption">Háblanos sobre el problema [Carácteres - Min: 100/Max: 512]</p>
                    <textarea name="e-desc" id="e-desc" onfocus="contarCaracteres();" oninput="contarCaracteres();" placeholder="Escribe aquí..." maxlength="512" style="resize: none;<?= isset($_SESSION["cache"]) ? 'outline: 2px solid var(--background-color);"' : '' ?>"><?= isset($_SESSION["cache"]) ? $_SESSION["cache"] : '' ?><?php unset($_SESSION["cache"]) ?></textarea>
                    <span id="counter" class="counter" style="display: flex; justify-content: end; font-size: 0.8em; margin-top: -3px;"></span>
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
    <script>
        function contarCaracteres() {
            var textarea = document.getElementById("e-desc");
            var contador = document.getElementById("counter");
            var maxCaracteres = textarea.getAttribute("maxlength");
            var numCaracteres = textarea.value.length;

            if (numCaracteres > maxCaracteres) {
                textarea.value = textarea.value.substring(0, maxCaracteres);
                numCaracteres = maxCaracteres;
            }

            contador.textContent = numCaracteres + "/512";
        }
</script>
    </script>
</body>
</html>