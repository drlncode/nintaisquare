<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    echo file_get_contents("https://nintaisquare.com/sources/controller/admin/data/statistics.json", true);
?>