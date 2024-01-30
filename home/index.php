<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - NintaiSquare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../sources/styles/index.css">
</head>
<body>
    <?php
        if (!isset($_SESSION["USER_AUTH"])) {
            require_once("../sources/templates/home/index-no-login.php");
            require_once("../sources/templates/home/footer.php");
        } else {
            require_once("../sources/templates/home/index-login.php");
            require_once("../sources/templates/home/footer.php");
        }
    ?>
</body>
</html>