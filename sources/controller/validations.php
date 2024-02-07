<?php
    require_once("pdo.php");

    //No login
    function noset() {
        if (!isset($_SESSION["USER_AUTH"])) {
            header("Location:");
            return;
        }
    }

    //Bienvenida
    function greats() {
        date_default_timezone_set("America/Santo_Domingo");
        $fecha = getdate();

        if ($fecha["hours"] === 0) {
            return "Buenas noches, ";
        } elseif ($fecha["hours"] > 18 || $fecha["hours"] < 6) {
            return "Buenas noches, ";
        } elseif ($fecha["hours"] >= 6 && $fecha["hours"] <= 12) {
            return "Buenos días, ";
        } elseif ($fecha["hours"] > 12 && $fecha["hours"] <= 18) {
            return "Buenas tardes, ";
        } else {
            return "Hola, ";
        }
    }

    //Formulario Inicio de sesión.
    function validate_signin($pdo) {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            if (empty($_POST["email"]) || empty($_POST["password"])) {
                echo($_SESSION["msg"] = "<span class='mensaje'><i class='fa-solid fa-circle-exclamation'></i>Rellene todos los campos.</span>");
                header("Location: http://localhost/nintaisquare/user/signin.php");
                return;
            } else {
                $sql = "SELECT COUNT(*) cuenta FROM users WHERE email = :em AND password = :pw;";
                $query = $pdo -> prepare($sql);
                $query -> execute(array(
                    ':em' => $_POST["email"],
                    ':pw' => $_POST["password"]
                ));
                while ($conteo = $query -> fetch(PDO::FETCH_ASSOC)) {
                    if ($conteo < 1) {
                        echo($_SESSION["msg"] = "<span class='mensaje'><i class='fa-solid fa-circle-exclamation'></i>Rellene todos los campos.</span>");
                        header("Location: http://localhost/nintaisquare/user/signin.php");
                        return;
                    } else {
                        
                    }
                }
            }
        }
    }

    //Formulario de registro.
    function validate_signup($pdo) {
        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
                return $_SESSION["msg"] = "<span class='mensaje'><i class='fa-solid fa-circle-exclamation'></i>Rellene todos los campos.</span>";
                header("Location: http://localhost/nintaisquare/user/signup.php");
                return;
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                return $_SESSION["msg"] = "<span class='mensaje'><i class='fa-solid fa-circle-exclamation'></i>Ingrese un email válido.</span>";
                header("Location: http://localhost/nintaisquare/user/signup.php");
                return;
            } else {

            }
        }
    }
?>