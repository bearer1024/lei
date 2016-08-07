<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $newsId = $_GET['newsId'];
    $sql = "select image from news where newsId = $newsId";
    require_once('db_config.php');
    $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die('unable to connect database');

    $r = mysqli_query($con,$sql);

    $result = mysqli_fetch_array($r);

    header('content-type: image/jpeg');

    echo base64_decode($result['image']);

    mysqli_close($con);
}else{
    echo "there have some error in getImage.php file";
}
