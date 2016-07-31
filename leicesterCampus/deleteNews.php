<?php
require_once('db_config.php');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die('unable to connect to database');

$newsid = $_GET['newsId'];

$sql = "delete from news where newsId = $newsid;";

//deleting record in database
if(mysqli_query($con,$sql)){
    echo 'news deleted successfully';
}else{
    echo 'could not delete news....Try again';
}

//closing connection
mysqli_close($con);
