<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    //geting values
    $newsId= $_POST['newsId'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    require_once('db_config.php');
    $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die('unable to connect database');

    //creating sql query
    $sql = "update news set title = '$title',content = '$content' where newsId = '$newsId';";

    //updating database table
    if (mysqli_query($con,$sql)){
        echo 'news update successfully';
    }else{
        echo 'could not update news...Try again';
    }
    //closing connection
}


