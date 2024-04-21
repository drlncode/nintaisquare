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

    if (!isset($_GET["pen-reports"]) && !isset($_GET["resp-reports"]) && !isset($_GET["ign-reports"]) && !isset($_GET["report-details"])) {
        header("Location: " . $_SERVER["REQUEST_URI"] . "?pen-reports");
        exit;
    }

    if (isset($_GET["answered"])) {
        $query_ans = $pdo -> prepare("UPDATE reports SET status = 'answered' WHERE id_report = :id");
        $query_ans -> execute (array(
            ':id' => $_GET["report-details"]
        ));

        header("Location: ../reports/");
        exit;
    } elseif (isset($_GET["ignored"])) {
        $query_ign = $pdo -> prepare("UPDATE reports SET status = 'ignored' WHERE id_report = :id");
        $query_ign -> execute (array(
            ':id' => $_GET["report-details"]
        ));

        header("Location: ../reports/");
        exit;
    } elseif (isset($_GET["slope"])) {
        $query_slope = $pdo -> prepare("UPDATE reports SET status = 'slope' WHERE id_report = :id");
        $query_slope -> execute (array(
            ':id' => $_GET["report-details"]
        ));

        header("Location: ../reports/");
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
                        <a href="?ign-reports" class="btn ign" style="border-bottom: <?= isset($_GET["ign-reports"]) ? "4px solid #dd5050; background-color: unset; color: #dd5050;" : "" ?>"><i class="fa-regular fa-circle-xmark"></i>Ignorados</a>
                    </div>
                    <div class="reports">
                        <?php
                            if (isset($_GET["pen-reports"])) {
                                $query_pen = $pdo -> query("SELECT * FROM reports WHERE `status` = 'slope'");
                                
                                while ($report_pen = $query_pen -> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <a href="?report-details=<?= $report_pen["id_report"] ?>">
                                        <div class="report pen-report">
                                            <p class="info"><i class="fa-regular fa-clock"></i><?php
                                                if ($report_pen["category_report"] == "e-o") {
                                                    echo $report_pen["by_report"] . " reportó un error no regístrado el <span style='font-style: italic; font-size: 0.9em;'>" . $report_pen["date_report"] . ".</span>";
                                                } else {
                                                    if ($report_pen["category_report"] == "e-d") {
                                                        echo $report_pen["by_report"] . " reportó un error de diseño el <span style='font-style: italic; font-size: 0.9em;'>" . $report_pen["date_report"] . ".</span>";
                                                    } elseif ($report_pen["category_report"] == "e-r") {
                                                        echo $report_pen["by_report"] . " reportó un error de regístro el <span style='font-style: italic; font-size: 0.9em;'>" . $report_pen["date_report"] . ".</span>";
                                                    } elseif ($report_pen["category_report"] == "e-e") {
                                                        echo $report_pen["by_report"] . " reportó un error al eliminar el <span style='font-style: italic; font-size: 0.9em;'>" . $report_pen["date_report"] . ".</span>";
                                                    }
                                                }
                                            ?>
                                            </p>
                                        </div>
                                    </a>
                                <?php }
                            } elseif (isset($_GET["resp-reports"])) { 
                                $query_ans = $pdo -> query("SELECT * FROM reports WHERE `status` = 'answered'");
                                
                                while ($report_ans = $query_ans -> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <a href="?report-details=<?= $report_ans["id_report"] ?>">
                                        <div class="report ans-report">
                                            <p class="info"><i class="fa-regular fa-circle-check"></i><?php
                                                if ($report_ans["category_report"] == "e-o") {
                                                    echo $report_ans["by_report"] . " reportó un error no regístrado el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ans["date_report"] . ".</span>";
                                                } else {
                                                    if ($report_ans["category_report"] == "e-d") {
                                                        echo $report_ans["by_report"] . " reportó un error de diseño el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ans["date_report"] . ".</span>";
                                                    } elseif ($report_ans["category_report"] == "e-r") {
                                                        echo $report_ans["by_report"] . " reportó un error de regístro el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ans["date_report"] . ".</span>";
                                                    } elseif ($report_ans["category_report"] == "e-e") {
                                                        echo $report_ans["by_report"] . " reportó un error al eliminar el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ans["date_report"] . ".</span>";
                                                    }
                                                }
                                            ?>
                                            </p>
                                        </div>
                                    </a>
                                <?php }
                            } else {
                                $query_ign = $pdo -> query("SELECT * FROM reports WHERE `status` = 'ignored'");
                                
                                while ($report_ign = $query_ign -> fetch(PDO::FETCH_ASSOC)) { ?>
                                    <a href="?report-details=<?= $report_ign["id_report"] ?>">
                                        <div class="report ign-report">
                                            <p class="info"><i class="fa-regular fa-circle-xmark"></i><?php
                                                if ($report_ign["category_report"] == "e-o") {
                                                    echo $report_ign["by_report"] . " reportó un error no regístrado el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ign["date_report"] . ".</span>";
                                                } else {
                                                    if ($report_ign["category_report"] == "e-d") {
                                                        echo $report_ign["by_report"] . " reportó un error de diseño el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ign["date_report"] . ".</span>";
                                                    } elseif ($report_ign["category_report"] == "e-r") {
                                                        echo $report_ign["by_report"] . " reportó un error de regístro el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ign["date_report"] . ".</span>";
                                                    } elseif ($report_ign["category_report"] == "e-e") {
                                                        echo $report_ign["by_report"] . " reportó un error al eliminar el <span style='font-style: italic; font-size: 0.9em;'>" . $report_ign["date_report"] . ".</span>";
                                                    }
                                                }
                                            ?>
                                            </p>
                                        </div>
                                    </a>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="report-details-container">
                    <div class="report-status">
                        <?php
                            $q_report = $pdo -> prepare("SELECT * FROM reports WHERE id_report = :id");
                            $q_report -> execute(array(
                                ':id' => $_GET["report-details"]
                            ));

                            if ($q_report -> rowCount() < 1) {
                                header("Location: ../");
                            } else {
                                $report = $q_report -> fetch(PDO::FETCH_ASSOC);
                                $img = $report["img_report"];

                                switch($report["status"]) {
                                    case "slope":
                                        echo "<p class='text slope'><i class='fa-regular fa-clock'></i>Reporte pendiente.</p>";
                                        break;
                                    case "answered":
                                        echo "<p class='text answered'><i class='fa-regular fa-circle-check'></i>Reporte respondido.</p>";
                                        break;
                                    case "ignored":
                                        echo "<p class='text ignored'><i class='fa-regular fa-circle-xmark'></i>Reporte ignorado.</p>";
                                        break;
                                    default:
                                        echo "Reporte.";
                                }
                            }
                        ?>
                    </div>
                    <div class="report-content">
                        <table class="table-container">
                            <tr>
                                <th colspan="2">Hecho por</th>
                            </tr>
                            <tr>
                                <td colspan="2"><?= $report["by_report"] ?></td>
                            </tr>
                            <tr>
                                <th>Categoría</th>
                                <th>Fecha</th>
                            </tr>
                            <tr>
                                <td><?= prettyCategoryReport($report["category_report"]); ?></td>
                                <td><?= $report["date_report"]; ?></td>
                            </tr>
                            <tr>
                                <th>Descripción</th>
                                <th>Imagen descriptiva.</th>
                            </tr>
                            <tr>
                                <td><?= $report["desc_report"]; ?></td>
                                <td><div class="img-container">
                                    <?= $img == NULL 
                                    ? "Sin imagen" 
                                    : "<img src='data:img/png;base64,$img'>" ?>
                                </div></td>
                            </tr>
                        </table>
                    </div>
                    <div class="report-actions">
                        <?php
                            if ($report["status"] == "slope") { ?>
                                <a href="<?= $_SERVER["REQUEST_URI"]; ?>&answered" class="btn ans-btn">Respondido</a>
                                <a href="<?= $_SERVER["REQUEST_URI"]; ?>&ignored" class="btn ign-btn">Ignorar</a>
                                <a href="../reports/" class="btn bck-btn">Volver</a>
                            <?php } else { ?>
                                <a href="<?= $_SERVER["REQUEST_URI"]; ?>&slope" class="btn slo-btn">Enviar a pendiente</a>
                                <a href="../reports/" class="btn bck-btn">Volver</a>
                            <?php }
                        ?>
                    </div>
                </div>
            <?php }
        ?>
    </div>
</body>
</html>