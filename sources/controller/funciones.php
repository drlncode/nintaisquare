<?php
    require_once("pdo.php");
    
    //No login.
    function noset() {
        if (!isset($_SESSION["USER_AUTH"])) {
            header("Location: https://nintaisquare.com/");
            return;
        }
    }

    //login.
    function set() {
        if (isset($_SESSION["USER_AUTH"])) {
            header("Location: https://nintaisquare.com/home/");
            return;
        }
    }

    //Validaciones de administrador.
    class admin_validation {
        public function noadmin() {
            if ($_SESSION["USER_AUTH"]["admin"] === false) {
                header("Location: https://nintaisquare.com/");
                return;
            }
        }

        public function admin_confirm() {
            if (!isset($_SESSION["USER_AUTH"]["admin_confirm"])) {
                header("Location: https://nintaisquare.com/sources/controller/admin/validation.php");
                return;
            }
        }

        public function admin_confirmed() {
            if (isset($_SESSION["USER_AUTH"]["admin_confirm"])) {
                header("Location: https://nintaisquare.com/sources/controller/admin/");
                return;
            }
        }
    }

    //Funciones y validaciones para el usuario.
    class user {
        public function own_profile() {
            if ($_GET["user_id"] == $_SESSION["USER_AUTH"]["user_id"]) {
                return true;
            } else {
                return false;
            }
        }
    }

    //Función para el saludo del home.
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
?>