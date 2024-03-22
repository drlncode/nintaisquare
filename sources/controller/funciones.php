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

    function filter_result_pretty() {
        if (isset($_GET["store-category"]) && isset($_GET["order-by"])) {
            switch ($_GET["store-category"]) {
                case "entretenimiento":
                    $_GET["store-category"] = "Entretenimiento";
                    break;
                case "comida":
                    $_GET["store-category"] = "Comida";
                    break;
                case "salud":
                    $_GET["store-category"] = "Salud";
                    break;
                case "deporte":
                    $_GET["store-category"] = "Deporte";
                    break;
                case "ropas":
                    $_GET["store-category"] = "Ropas";
                    break;
                case "tecnologia":
                    $_GET["store-category"] = "Tecnología";
                    break;
                case "c-basica":
                    $_GET["store-category"] = "Canasta básica";
                    break;
                case "mecanica":
                    $_GET["store-category"] = "Mecánica";
                    break;
                case "v-generales":
                    $_GET["store-category"] = "Ventas generales";
                    break;
            }

            switch ($_GET["order-by"]) {
                case "DESC":
                    $_GET["order-by"] = "Más nuevo";
                break;
                case "ASC":
                    $_GET["order-by"] = "Más antiguo";
                break;
            }

            return $_GET["store-category"] && $_GET["order-by"];
        } elseif (isset($_GET["product-category"]) && isset($_GET["order-by"])) {
            switch ($_GET["product-category"]) {
                case "entretenimiento":
                    $_GET["product-category"] = "Entretenimiento";
                    break;
                case "comida":
                    $_GET["product-category"] = "Comida";
                    break;
                case "salud":
                    $_GET["product-category"] = "Salud";
                    break;
                case "deporte":
                    $_GET["product-category"] = "Deporte";
                    break;
                case "ropas":
                    $_GET["product-category"] = "Ropas";
                    break;
                case "tecnologia":
                    $_GET["product-category"] = "Tecnología";
                    break;
                case "c-basica":
                    $_GET["product-category"] = "Canasta básica";
                    break;
                case "mecanica":
                    $_GET["product-category"] = "Mecánica";
                    break;
                case "v-generales":
                    $_GET["product-category"] = "Ventas generales";
                    break;
            }

            switch ($_GET["order-by"]) {
                case "DESC":
                    $_GET["order-by"] = "Más nuevo";
                break;
                case "ASC":
                    $_GET["order-by"] = "Más antiguo";
                break;
            }

            return $_GET["product-category"] && $_GET["order-by"];
        }
    }

    function prettyCategory($value) {
        switch ($value) {
            case "entretenimiento":
                $value = "Entretenimiento";
                break;
            case "comida":
                $value = "Comida";
                break;
            case "salud":
                $value = "Salud";
                break;
            case "deporte":
                $value = "Deporte";
                break;
            case "ropas":
                $value = "Ropas";
                break;
            case "tecnologia":
                $value = "Tecnología";
                break;
            case "c-basica":
                $value = "Canasta básica";
                break;
            case "mecanica":
                $value = "Mecánica";
                break;
            case "v-generales":
                $value = "Ventas generales";
                break;
        }

        return $value;
    }

    function prettyPrice($value) {
        switch ($value) {
            case "free":
                $value = "$" . "Gratis";
            break;
            default:
                $value = "$" . $value;
            break;
        }

        return $value;
    }
?>