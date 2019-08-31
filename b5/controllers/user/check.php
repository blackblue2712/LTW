<?php
    include_once("../../connect.php");
    $array_errors = [];

    if( isset($_GET["username"])) {
        $username = $_GET["username"];
        $query = "SELECT id FROM thanhvien WHERE tendangnhap='".$username."'";
        $result = mysqli_query($link, $query);
        if($result->num_rows > 0) {
            $array_errors["message"] = "User with ".$username." name already exists!";
            echo json_encode($array_errors);
        }
    }
