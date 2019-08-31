<?php

    session_start();
    include_once("../../connect.php");
    include_once("../../define.php");
    $array_errors = [];
    $userId = $_SESSION["user"]["id"];
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";



    if(isset($_GET["role"]) && $_GET["role"] == "getsingle") {
        $id = $_GET["id"];
        $query = "SELECT * FROM sanpham WHERE idsp=".$id. " AND idtv='".$userId."'";
        $result = mysqli_query($link, $query);
        $products = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products["name"] = $row["tensp"];
                $products["price"] = $row["giasp"];
                $products["description"] = $row["chitietsp"];
                $products["picture"] = $row["hinhanhsp"];
                $products["idProduct"] = $row["idsp"];
                $products["idUser"] = $row["idtv"];
            }
            $products["URL_PIC"] = URL_UPLOAD_PRODUCT;
            echo json_encode($products);
        }
    } else if(isset($_GET["role"]) && $_GET["role"] == "getall") {
        $query = "SELECT * FROM sanpham WHERE idtv='".$userId."'";
        $result = mysqli_query($link, $query);
        $products = [];
        $i = 0;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products[$i]["name"] = $row["tensp"];
                $products[$i]["price"] = $row["giasp"];
                $products[$i]["description"] = $row["chitietsp"];
                $products[$i]["picture"] = $row["hinhanhsp"];
                $products[$i]["idProduct"] = $row["idsp"];
                $products[$i]["idUser"] = $row["idtv"];
                $i++;
            }
            $products[$i]["URL_PIC"] = URL_UPLOAD_PRODUCT;
            echo json_encode($products);
        }else {
            array_push($array_errors, "Can not fetch product");
            echo json_encode($array_errors);
        }
    } else if(isset($_GET["role"]) && $_GET["role"] == "getQuery") {
        $query = "SELECT * FROM sanpham WHERE tensp LIKE '%".$_GET["q"]."%' AND idtv='".$userId."'";
        $result = mysqli_query($link, $query);
        $products = [];
        $i = 0;
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products[$i]["name"] = $row["tensp"];
                $products[$i]["price"] = $row["giasp"];
                $products[$i]["description"] = $row["chitietsp"];
                $products[$i]["picture"] = $row["hinhanhsp"];
                $products[$i]["idProduct"] = $row["idsp"];
                $products[$i]["idUser"] = $row["idtv"];
                $i++;
            }
            $products[$i]["URL_PIC"] = URL_UPLOAD_PRODUCT;
            echo json_encode($products);
        }else {
            array_push($array_errors, "Can not fetch product");
            echo json_encode($array_errors);
        }
    }