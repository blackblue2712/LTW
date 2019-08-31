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

    if(!isset($_SESSION["user"])) {
        header("location: ../../");
        return;
    }

    if( isset($_POST["btnSubmit"]) && $_GET["role"] == "add") {
        $picture = "";
        if($_FILES["picture"]["error"] == 0) {
            $file = $_FILES["picture"];
            $destination = PATH_UPLOAD_PRODUCT;

            $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);    // need to check
            $fileSize = $file["size"];
            $fileName = randomString().$file["name"];
            $fileTmp = $file["tmp_name"];
            $fileUpload = $destination . "/" .$fileName;
            
            if(!move_uploaded_file($fileTmp, $fileUpload)) {
                array_push($array_errors, $array_errors, "File up load fail");
                return false;
            }else {
                $picture = mysqli_real_escape_string($link, $fileName);
            }

        }

        // update database
        $name = mysqli_real_escape_string($link, $_POST["name"]);
        $description = mysqli_real_escape_string($link, $_POST["description"]);
        $price = mysqli_real_escape_string($link, $_POST["price"]);
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
        // Check if exist file, then delete old file
        $name           = mysqli_real_escape_string($link, $_POST["name"]);
        $price          = mysqli_real_escape_string($link, $_POST["price"]);
        $description    = mysqli_real_escape_string($link, $_POST["description"]);
        $id             = mysqli_real_escape_string($link, $_POST["id"]);
        $picture        = $_POST["oldPicture"];


        $pictureInfo    = $_FILES["picture"]["error"] > 0 ? "" : $_FILES["picture"];
        $destination    = PATH_UPLOAD_PRODUCT;
        if($pictureInfo != "") {
            $fileType       = pathinfo($pictureInfo["name"], PATHINFO_EXTENSION);    // need to check
            $fileSize       = $pictureInfo["size"];
            $fileName       = randomString().$pictureInfo["name"];
            $fileTmp        = $pictureInfo["tmp_name"];
            $fileUpload     = $destination . "/" .$fileName;

            $oldPicture = $_POST["oldPicture"];
            if(file_exists(PATH_UPLOAD_PRODUCT . "/" . $oldPicture)) {
                @unlink(PATH_UPLOAD_PRODUCT . "/" . $oldPicture);
            }


            if(!move_uploaded_file($fileTmp, $fileUpload)) {
                array_push($array_errors, $array_errors, "File up load fail");
                return false;
            }else {
                $picture = mysqli_real_escape_string($link, $fileName);
            }
        }

        


        $query      = "UPDATE sanpham SET tensp='".$name."', giasp='".$price."', chitietsp='".$description."', hinhanhsp='".$picture."' WHERE idsp='".$id."' ";
        
        if(mysqli_query($link, $query)) {
            $array_mess["message"] = "Update success";
        }else {
            array_push($array_errors, "Can not fetch product");
            // echo json_encode($array_errors);
        }

        header("location: ../../home.php");
    } else if(isset($_GET["role"]) && $_GET["role"] == "delete") {
        $id = $_GET["id"];
        $query = "SELECT hinhanhsp FROM sanpham WHERE idsp='".$id."'";
        $result = mysqli_query($link, $query);
        if($result->num_rows) {
            $picture = $result->fetch_assoc()["hinhanhsp"];
            if($picture != "") {
                @unlink(PATH_UPLOAD_PRODUCT . "/" . $picture);
            }
        }

        $queryDelete = "DELETE FROM sanpham WHERE idsp='".$id."'";
        if(mysqli_query($link, $queryDelete)) {
            $array_mess["message"] = 'Product with id '.$id.' was deleted';
            echo json_encode($array_mess);
        }
    }