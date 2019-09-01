<?php
    session_start();
    $arr_mes = [];
    if(!isset($_GET["default"])) {
        $_SESSION["config"]["backgroundColor"] = $_GET["confBg"];
        $_SESSION["config"]["color"] = $_GET["confCl"];
        $_SESSION["config"]["fontSize"] = $_GET["confSz"];

        $arr_mes["message"] = "Config saved";
    } else {
        unset($_SESSION["config"]);

        $arr_mes["message"] = "Config deleted";
    }

    echo json_encode($arr_mes);

