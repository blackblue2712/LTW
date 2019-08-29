<?php
    session_start();
    include_once("../../connect.php");
    $array_errors = [];

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    if( isset($_POST["username"])) {
        // Check if user exists
        $username = $_POST["username"];
        $query_check = "SELECT id FROM thanhvien WHERE `tendangnhap` = '".$username."' ";

        $user = $link->query($query_check);
        if($user->num_rows > 0) {
            array_push($array_errors, "User with that name has already exists");
        } else {
            $password = $_POST["password"];
            $gender = $_POST["gender"];
            $career = $_POST["career"];
            $hobbyArr = isset($_POST["hobby"]) ? $_POST["hobby"] : "";
            $hobbies = "";
            $picture = "";
            if(is_array($hobbyArr)) {
                foreach ($hobbyArr as $key => $value) {
                    $hobbies .= $value . "-";
                }
            }
            // upload file if user choose file
            if($_FILES["picture"]["error"] == 0) {
                $file = $_FILES["picture"];
                $destination = PATH_UPLOAD_USER;
    
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
            $query = "INSERT INTO thanhvien (tendangnhap, matkhau, hinhanh, gioitinh, nghenghiep, sothich)
                        VALUES('".$username."', '".md5($password)."', '".$picture."', '".$gender."', '".$career."', '".$hobbies."')";
            
            if(mysqli_query($link, $query)) {
                // echo json_decode($mess);
            } else {
                echo json_decode($array_errors);
            }
        }

        if(count($array_errors) > 0) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["content"] = $array_errors[0];
        } else {
            $_SESSION["message"]["type"] = "success";
            $_SESSION["message"]["content"] = "Signin successfully";
        }
    }

    header("location: ../../");