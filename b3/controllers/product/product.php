<?php

    session_start();
    include_once("../../connect.php");
    include_once("../../define.php");
    $array_errors = [];
    $array_mess = [];

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";



    if( isset($_POST["btnSubmit"]) && $_GET["role"] == "add") {
        if($_FILES["picture"]["error"] == 0) {
            $file = $_FILES["picture"];
            $destination = PATH_UPLOAD_PRODUCT;

            $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);    // need to check
            $fileSize = $file["size"];
            $fileName = $file["name"];
            $fileTmp = $file["tmp_name"];
            $fileUpload = $destination . "/" .$fileName;
            
            if(!move_uploaded_file($fileTmp, $fileUpload)) {
                array_push($array_errors, $array_errors, "File up load fail");
                return false;
            }else {
                $picture = $fileName = $file["name"];
            }
        }

        // update database
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $userId = $_SESSION["user"]["id"];
        $query = "INSERT INTO sanpham (tensp, chitietsp, giasp, hinhanhsp, idtv)
                    VALUES('".$name."', '".$description."', '".$price."', '".$picture."', '".$userId."')";
        
        if(mysqli_query($link, $query)) {
            // echo json_decode($mess);
        } else {
            echo json_decode($array_errors);
        }

        if(count($array_errors) > 0) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["content"] = $array_errors[0];
        } else {
            $_SESSION["message"]["type"] = "success";
            $_SESSION["message"]["content"] = "Add new product ".$name." successfully";
        }
        header("location: ../../home.php");
    } else if(isset($_GET["role"]) && $_GET["role"] == "edit") {
        $name           = $_POST["name"];
        $price          = $_POST["price"];
        $description    = $_POST["description"];
        $id             = $_POST["id"];

        $query      = "UPDATE sanpham SET tensp='".$name."', giasp='".$price."', chitietsp='".$description."' WHERE idsp='".$id."' ";
        
        if(mysqli_query($link, $query)) {
            $array_mess["message"] = "Update success";
        }else {
            array_push($array_errors, "Can not fetch product");
            // echo json_encode($array_errors);
        }

        header("location: ../../home.php");
    }

    