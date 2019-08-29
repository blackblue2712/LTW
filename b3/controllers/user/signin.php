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
        $password = $_POST["password"];
        $query_check = "SELECT * FROM thanhvien WHERE `tendangnhap` = '".$username."' ";

        $user = $link->query($query_check);
        if($user->num_rows > 0) {
            while($row = $user->fetch_assoc()) {
                if($row["matkhau"] == md5($password)) {
                    // start login
                    $_SESSION["user"]["id"] = $row["id"];
                    $_SESSION["user"]["username"] = $row["tendangnhap"];
                    $_SESSION["user"]["picture"] = $row["hinhanh"];
                    $_SESSION["user"]["gender"] = $row["gioitinh"];
                    $_SESSION["user"]["career"] = $row["nghenghiep"];
                    $_SESSION["user"]["hobbies"] = $row["sothich"];
                } else {
                    array_push($array_errors, "Password do not match");
                }
            }
        } else {
            array_push($array_errors, "User with that name is not exists");
        }

        if(count($array_errors) > 0) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["content"] = $array_errors[0];
            header("location: ../../signin.php");
        } else {
            header("location: ../../home.php");
        }
    }
