<?php
    if (empty($_GET["store-category"]) || empty($_GET["order-by"])) {
        header("Location: ../?action=stores");
        exit;
    } elseif (isset($_GET["store-category"]) && isset($_GET["order-by"])) {
        header("Location: ../?action=stores&store-category=" . $_GET["store-category"] . "&order-by=" . $_GET["order-by"] . "");
        exit;
    }
?>