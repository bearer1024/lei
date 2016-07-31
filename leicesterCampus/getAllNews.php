<?php
require_once('db_config.php');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die ('unable to connect database');

//creating sql query
$sql = "select * from news";

//getting result
$r = mysqli_query($con,$sql);

//creating a blank array
$result = array();

//looping through all the records fetched
while($row = mysqli_fetch_array($r)){
    //pushing name and id in the bank array created
    array_push($result,array("newsId" => $row['newsId'],"title" => $row['title']));
}

//displaying the array in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);

