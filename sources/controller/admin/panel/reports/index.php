<?php
    session_start();
    require_once("../../../funciones.php");
    require_once("../../../pdo.php");
    noset();
    $admin = new admin_validation; //Linea 19 funciones.php
    $admin -> noadmin();
    $admin -> admin_confirm();

    if (isset($_GET["salir"])) {
        unset($_SESSION["USER_AUTH"]["admin_confirm"]);
        header("Location: https://nintaisquare.com/");
        return;
    }

    if (!isset($_GET["pen-reports"]) && !isset($_GET["resp-reports"]) && !isset($_GET["report-details"])) {
        header("Location: " . $_SERVER["REQUEST_URI"] . "?pen-reports");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes | NintaiSquare</title>
    <link rel="stylesheet" href="../../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../../assets/styles/admin.css">
    <link rel="stylesheet" href="../../../../assets/styles/admin-reports.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon" href="../../../../assets/img/favicon.png">
</head>
<body>
    <div class="container">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }
        ?>
        <div class="admin-header-container">
            <div class="admin-header-content">
                <div class="content-img">
                    <img src="../../../../assets/img/logo.png" alt="Logo">
                </div>
                <div class="content-nav">
                    <ul class="nav-list-container">
                        <li class="nav-list-content"><a href="../../">Inicio</a></li>
                        <li class="nav-list-content"><a href="../">Panel</a></li>
                        <li class="nav-list-content"><a href="../../history/">Historial</a></li>
                    </ul>
                </div>
                <div class="content-out">
                    <a href="index.php?salir"><i class="fa-solid fa-arrow-right-from-bracket"></i>Salir</a>
                </div>
            </div>
        </div>
        <?php
            if (!isset($_GET["report-details"])) { ?>
                <div class="reports-container">
                    <div class="reports-container-header">
                        <h2 class="title"><i class="fa-solid fa-bug"></i>Reportes</h2>
                    </div>
                    <div class="nav-reports">
                        <a href="?pen-reports" class="btn pen" style="border-bottom: <?= isset($_GET["pen-reports"]) ? "4px solid #e7c83e; background-color: unset; color: #e7c83e;" : "" ?>"><i class="fa-regular fa-clock"></i>Pendientes</a>
                        <a href="?resp-reports" class="btn resp" style="border-bottom: <?= isset($_GET["resp-reports"]) ? "4px solid #55b955; background-color: unset; color: #55b955;" : "" ?>"><i class="fa-regular fa-circle-check"></i>Respondidos</a>
                    </div>
                    <?php
                        if (isset($_GET["pen-reports"])) {
                            $query_pen = $pdo -> query("SELECT * FROM reports WHERE `status` = 'slope'");
                            
                            while ($report_pen = $query_pen -> fetch(PDO::FETCH_ASSOC)) { ?>
                                <a href="?report-details=<?= $report_pen["id_report"] ?>">
                                    <div class="report pen-report">
                                        <p class="info"><i class="fa-regular fa-clock"></i><?php
                                            if ($report_pen["category_report"] == "e-o") {
                                                echo $report_pen["by_report"] . " reportó un error no regístrado el " . $report_pen["date_report"] . ".";
                                            } else {
                                                if ($report_pen["category_report"] == "e-d") {
                                                    echo $report_pen["by_report"] . " reportó un error de diseño el " . $report_pen["date_report"] . ".";
                                                } elseif ($report_pen["category_report"] == "e-r") {
                                                    echo $report_pen["by_report"] . " reportó un error de regístro el " . $report_pen["date_report"] . ".";
                                                } elseif ($report_pen["category_report"] == "e-e") {
                                                    echo $report_pen["by_report"] . " reportó un error al eliminar el " . $report_pen["date_report"] . ".";
                                                }
                                            }
                                        ?>
                                        </p>
                                    </div>
                                </a>
                            <?php }
                        } else { 

                        }
                    ?>
                </div>
            <?php } else { ?>
                <div class="report-details-container">
                    <div class="report-status"></div>
                </div>
            <?php }
        ?>
    </div>
</body>
</html>