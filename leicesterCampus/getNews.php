<?php

//Getting the request id
$newsId = $_GET["newsId"];

require_once('db_config.php');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die('unable to connect database');

//creating sql query with where clause to get an specific employee
$sql = "select * from news where newsId=$newsId";

//getting result
$r = mysqli_query($con,$sql);

//putting result to an array
$result = array();
$row = mysqli_fetch_array($r);
array_push($result,array("newsId" =>$row['newsId'],"title"=>$row['title'],"content"=>$row['content'],"pubDate"=>$row["pubDate"],"image" => $row['image']));

//displaying in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);
