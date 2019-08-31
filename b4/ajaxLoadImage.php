<?php
    include("../b3/connect.php");
    $query = "SELECT hinhanhsp, tensp FROM sanpham";
    $result = mysqli_query($link, $query);
    $arr_img = [];
    if($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $arr_img[$i]["image"] = $row["hinhanhsp"];
            $arr_img[$i]["name"] = $row["tensp"];
            $i++;
        }
    }
    // array_push($arr_img, URL_UPLOAD_PRODUCT);

    echo json_encode($arr_img);
?>