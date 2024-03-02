<?php
    session_start();
    require_once("../sources/controller/funciones.php");
    require_once("../sources/controller/pdo.php");
    noset();

    if (isset($_POST["t-name"])) {
        if (empty($_POST["t-name"]) || empty($_POST["t-categoria"]) || empty($_POST["t-desc"]) || empty($_POST["t-direcc"]) || empty($_POST["t-tel"])) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Rellene los campos no opcionales.</span>";
            header("Location: index.php?action=store");
            return;
        } elseif (strlen($_POST["t-desc"]) > 256) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Descripción muy larga, Max: 256 carácteres.</span>";
            header("Location: index.php?action=store");
            return;
        } elseif (!is_numeric($_POST["t-tel"])) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Formato del número de teléfono incorrecto.</span>";
            header("Location: index.php?action=store");
            return;
        } elseif ($_FILES["t-logo"]["size"] == 0) {
            $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>Ingrese una imagen.</span>";
            header("Location: index.php?action=store");
            return;
        } else {
            if ($_FILES["t-logo"]["size"] / 1024 > 2048) {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>La imagen sobrepasa el limite de 2MB.</span>";
                header("Location: index.php?action=store");
                return;
            } elseif ($_FILES["t-logo"]["type"] !== "image/png" && "image/jpg" && "image/jpeg") {
                $_SESSION["msg"] = "<span class='mensaje-error'><i class='fa-solid fa-circle-exclamation'></i>El formato de la imagen no es el esperado.</span>";
                header("Location: index.php?action=store");
                return;
            } else {
                $query = "INSERT INTO pen_stores (user_id, store_name, store_category, store_desc, store_img, store_address, store_tel, store_email, store_social_ig, store_social_tw, store_social_fc) VALUES (:uid, :sn, :sc, :sd, :si, :sa, :st, :se, :ssi, :sst, :ssf)";
                $insert = $pdo -> prepare($query);
                $insert -> execute(array(
                    ':uid' => $_SESSION["USER_AUTH"]["user_id"],
                    ':sn' => htmlentities($_POST["t-name"]),
                    ':sc' => $_POST["t-categoria"],
                    ':sd' => htmlentities($_POST["t-desc"]),
                    ':si' => base64_encode(file_get_contents($_FILES["t-logo"]["tmp_name"])),
                    ':sa' => htmlentities($_POST["t-direcc"]),
                    ':st' => htmlentities($_POST["t-tel"]),
                    ':se' => htmlentities($_POST["t-email"]),
                    ':ssi' => htmlentities($_POST["t-instagram"]),
                    ':sst' => htmlentities($_POST["t-twitter"]),
                    ':ssf' => htmlentities($_POST["t-facebook"])
                ));
                    
                $_SESSION["msg"] = "<span class='mensaje-success'><i class='fa-solid fa-circle-check'></i>¡Registro enviado! En espera de aprobación.</span>";
                header("Location: https://nintaisquare.com/create/");
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
    <title>Crear | NintaiSquare</title>
    <link rel="stylesheet" href="../sources/assets/styles/create.css">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo($_SESSION["msg"]);
                unset($_SESSION["msg"]);
            }

            require_once("../sources/templates/header/header-login.php");

            if (!isset($_GET["action"])) { ?>
                <div class="container-content">
                    <div class="content">
                        <div class="content-h2">
                            <h2>Qué quieres hacer?</h2>
                        </div>
                        <div class="container-options">
                            <div class="option-content option-store">
                                <a href="index.php?action=store" class="option">
                                    <h3 class="option-title"><i class="fa-solid fa-pen-to-square"></i>Registrar tienda.</h3>
                                    <p class="option-caption">Aqui podrás registrar tu tienda, agregarle una descripción y los datos que le servirán a los usuarios para localizar tu tienda y sus productos.</p>
                                </a>
                            </div>
                            <div class="option-content option-product">
                                <a href="index.php?action=product" class="option">
                                    <h3 class="option-title"><i class="fa-solid fa-pen-to-square"></i>Registrar producto.</h3>
                                    <p class="option-caption">Aqui podrás registrarle productos a tus tiendas registradas, agregarle una descripción y los datos que le servirán a los usuarios para localizar tu tienda y adquirirlos.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } elseif (isset($_GET["action"]) && $_GET["action"] == "store") {
                require_once("../sources/templates/home/create/store.php");
            } elseif (isset($_GET["action"]) && $_GET["action"] == "product") {
                require_once("../sources/templates/home/create/product.php");
            } else {
                header("Location: https://nintaisquare.com/");
                return; 
            }

            require_once("../sources/templates/footer/footer.php");
        ?>
    </div>
</body>
</html>