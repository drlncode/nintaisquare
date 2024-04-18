<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Soporte NintaiSquare">
    <meta name="description" content="Te damos la bienvenida a la sección de soporte de NintaiSquare">
    <title>Soporte | NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/support.css">
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon-support.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }

            require_once("../sources/templates/support/support-header.php")
        ?>
        <div class="content">
            <div class="sub-header-container">
                <h1 class="sub-header-title"><i class="fa-solid fa-headset"></i>Soporte</h1>
                <span class="sub-header-text">Te damos la bienvenida a la sección de soporte de NintaiSquare, aqui podrás ponerte en contacto con nuestro personal para resolver tus dudas o incovenientes.</span>
            </div>
            <div class="options-container">
                <a href="contact-us/">
                    <div class="option contact-us">
                        <div class="option-title">
                            <h3 class="title"><i class="fa-solid fa-comments"></i>Contáctanos</h3>
                        </div>
                        <div class="option-content">
                            <span class="text">Podrás descubrir como ponerte en contacto con nuestro equipo.</span>
                        </div>
                    </div>
                </a>
                <a href="report-bug/">
                    <div class="option report-something">
                        <div class="option-title">
                            <h3 class="title"><i class="fa-solid fa-triangle-exclamation"></i>Reportar un error</h3>
                        </div>
                        <div class="option-content">
                            <span class="text">Reporta cualquier error que surga en la plataforma para su pronta solución.</span>
                        </div>
                    </div>
                </a>
                <a href="guide/">
                    <div class="option how-use">
                        <div class="option-title">
                            <h3 class="title"><i class="fa-solid fa-circle-question"></i>Cómo utilizar</h3>
                        </div>
                        <div class="option-content">
                            <span class="text">Descubre todo acerca de como utilizar NintaiSquare y sus funcionalidades.</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="support-questions" id="frequent-questions">
                <h2 class="title"><i class="fa-regular fa-circle-question"></i>Preguntas frecuentes</h2>
                <div class="questions">
                    <details>
                        <summary>Que es NintaiSquare?</summary>
                        <p class="p-text">NintaiSquare es una plataforma que te ayuda a impulsar tu negocio al siguiente nivel, en la cual puedes registrar tu tienda y sus productos de forma gratuita.</p>
                    </details>
                    <details>
                        <summary>Cuantas tiendas y productos puedo registrar?</summary>
                        <p class="p-text">Actualmente no hay un limite específico de tiendas y productos que el usuario puede registrar, pero en un futuro no muy lejano se tiene pensado implementarlo.</p>
                    </details>
                    <details>
                        <summary>Cuanto tiempo tardan en aprobar mi tienda y productos?</summary>
                        <p class="p-text">En circunstacias normales, nuestro equipo de verificación de tiendas y productos no tarda más de 24 horas en tomar una decisión, ya sea aprobar o rechazar su tienda o productos.</p>
                    </details>
                    <details>
                        <summary>Perdí mi cuenta, como la recupero?</summary>
                        <p class="p-text">Si acaba de perder acceso a su cuenta de NintaiSquare, póngase en contacto con nosotros mediante nuestro correo electrónico: <b>nintaisquare@nintaisquare.com</b>. Obtendrá respuesta en un lapso de tiempo máximo de 24 horas.</p>
                    </details>
                    <details>
                        <summary>Por qué el contenido no está disponible en dispositivos móviles?</summary>
                        <p class="p-text">Actualmente NintaiSquare (aparte de la sección de soporte) no está disponible para pantallas pequeñas por dos razones: Complejidad y falta de tiempo. Sabemos que esto nos juega en contra, pero actualmente es muy complicado el adaptar la web a dispositivos móviles por la gran cantidad de contenido que posee. Pero no descartamos el adaptarla a dispositivos móviles en un futuro.</p>
                        <div id="last" style="display: none;"></div>
                    </details>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once("../sources/templates/support/support-footer.php");
    ?>
</body>
</html>