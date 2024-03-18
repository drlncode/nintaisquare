<?php
    if (isset($_GET["store-category"]) && empty($_GET["store-category"]) || empty($_GET["order-by"])) {
        header("Location: ../?action=stores");
        exit;
    } elseif (isset($_GET["store-category"]) && isset($_GET["order-by"])) {
        header("Location: ../?action=stores&store-category=" . $_GET["store-category"] . "&order-by=" . $_GET["order-by"] . "");
        exit;
    } elseif (isset($_GET["product-category"]) && empty($_GET["product-category"]) || empty($_GET["order-by"])) {
        header("Location: ../?action=products");
        exit;
    } elseif (isset($_GET["product-category"]) && isset($_GET["order-by"])) {
        header("Location: ../?action=products&product-category=" . $_GET["product-category"] . "&order-by=" . $_GET["order-by"] . "");
        exit;
    }
?>