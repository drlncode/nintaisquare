<?php
    session_start();
    unset($_SESSION["USER_AUTH"]);
    header("Location: https://nintaisquare.com");
    return;
?>