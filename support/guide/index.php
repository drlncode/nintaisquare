<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guías | NintaiSquare</title>
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

        require_once("../../sources/templates/support/support-header.php")
    ?>
    <div class="guides-container">
        <div class="header">
            <h2 class="title"><i class="fa-regular fa-compass"></i>Guías</h2>
            <a href="../" class="back"><i class="fa-solid fa-arrow-left"></i>Ir al contenido principal</a>
        </div>
        <div class="guides-content">
            <div class="guides">
                <div class="guide" id="how-to-register-store">
                    <div class="guide-header">
                        <h3 class="title"><i class="fa-solid fa-book-open-reader"></i>Cómo regístrar una tienda?</h3>
                    </div>
                    <div class="guide-content">
                        <p class="text">
                            Para registrar una tienda en NintaiSquare es necesario que se haya regístrado, una vez hecho, puede proceder con los siguientes pasos.<br><br>
                            1. En el parte superior ubique la opción "Crear" y haga click.<br>
                            2. Siguiente, elija la opción "Regístrar tienda".<br>
                            3. posteriormente dentro, rellene los datos solicitados.<br>
                            4. Una vez haya terminado, haga click en el botón "Registrar".<br><br>
                            <i>Nota: Tenga en cuenta que los 6 primeros campos son obligarios.</i><br><br>
                            Es recomendable que no rellene ningún campo apresuradamente y que se tome su tiempo, puesto que, los detalles no se pueden editar más adelante.
                        </p>
                    </div>
                </div>
                <div class="divisor"></div>
                <div class="guide" id="how-to-register-products">
                    <div class="guide-header">
                        <h3 class="title"><i class="fa-solid fa-book-open-reader"></i>Cómo regístrar productos?</h3>
                    </div>
                    <div class="guide-content">
                        <p class="text">
                            Para registrar un producto para su tienda en NintaiSquare es necesario que se haya regístrado una tienda y que la misma haya sido aprobada, una vez hecho, puede proceder con los siguientes pasos.<br><br>
                            1. En el parte superior ubique la opción "Crear" y haga click.<br>
                            2. Siguiente, elija la opción "Regístrar producto".<br>
                            3. posteriormente dentro, rellene los datos solicitados.<br>
                            4. Una vez haya terminado, haga click en el botón "Registrar".<br><br>
                            <i>Nota: Tenga en cuenta que todos los campos son obligarios.</i><br><br>
                            Es recomendable que no rellene ningún campo apresuradamente y que se tome su tiempo, puesto que, los detalles no se pueden editar más adelante.
                        </p>
                    </div>
                </div>
                <div class="divisor"></div>
            </div>
            <div class="indice">
                <div class="indice-content">
                    <h4 class="title-content"><i class="fa-solid fa-list-ul"></i>Índice</h4>
                    <div class="list">
                        <a href="#how-to-register-store" class="link"><i class="fa-solid fa-circle"></i>Cómo regístrar una tienda.</a>
                        <a href="#how-to-register-products" class="link"><i class="fa-solid fa-circle"></i>Cómo regístrar productos.</a>
                        <a href="#how-see-pen-stores" class="link"><i class="fa-solid fa-circle"></i>Cómo ver tiendas las pendientes.</a>
                        <a href="#how-delete-all-my-stores" class="link"><i class="fa-solid fa-circle"></i>Cómo eliminar todas mis tienda.</a>
                        <a href="#how-delete-all-my-products" class="link"><i class="fa-solid fa-circle"></i>Cómo eliminar todas mis productos.</a>
                        <a href="#how-change-email" class="link"><i class="fa-solid fa-circle"></i>Cómo cambiar mi correo.</a>
                        <a href="#how-change-pw" class="link"><i class="fa-solid fa-circle"></i>Cómo cambiar mi contraseña.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once("../../sources/templates/support/support-footer.php");
    ?>
    </div>
</body>
</html>