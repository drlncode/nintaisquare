<?php
    session_start();
    require_once("../sources/controller/pdo.php");
    require_once("../sources/controller/funciones.php");
    $user = new user;

    if (is_object($user)) {
        //Validando existencia.
        $sql = "SELECT count(*) `exists` FROM users WHERE user_id = :id";
        $query = $pdo -> prepare($sql);
        $query -> execute(Array(
            ':id' => htmlentities($_GET["user_id"])
        ));
        $query = $query -> fetch(PDO::FETCH_ASSOC);

        if ($query["exists"] == 0) {
            header("Location: ../");
            return;
        } else {
            $sql = "SELECT * FROM users WHERE user_id = :id";
            $query = $pdo -> prepare($sql);
            $query -> execute(Array(
                ':id' => htmlentities($_GET["user_id"])
            ));
            $user_data = $query -> fetch(PDO::FETCH_ASSOC);

            if ($user_data["admin"] == 1) {
                $user_data["admin"] = true;
            } else {
                $user_data["admin"] = false;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user_data["name"] ?> | NintaiSquare</title>
    <link rel="icon" type="image/x-icon" href="../sources/assets/img/favicon.png">
    <link rel="stylesheet" href="../sources/assets/styles/root.css">
    <link rel="stylesheet" href="../sources/assets/styles/index-l.css">
    <link rel="stylesheet" href="../sources/assets/styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?= require_once("../sources/templates/header/header-login.php"); ?>
    <div class="user-container">

    </div>
    <?= require_once("../sources/templates/footer/footer.php");?>
</body>
</html>