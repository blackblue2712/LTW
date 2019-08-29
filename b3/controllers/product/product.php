<?php

    session_start();
    include_once("../../connect.php");
    $array_errors = [];

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($_GET);
    echo "</pre>";



    if( isset($_POST["btnSubmit"])) {
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
        $query = "INSERT INTO sanpham (tensp, chitietsp, giasp, hinhanhsp)
                    VALUES('".$name."', '".$description."', '".$price."', '".$picture."')";
        
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
    }

    header("location: ../../home.php");