<?php
if($_SERVER["REQUEST_METHOD"] == "POST) {

//geting values
$title= $_POST['title'];

////////////////////////////////todo: post user_name to here

$writer = $_POST['user_name'];
$content = $_POST['content'];
$links = $_POST ['links'];


///////////////////////////////todo if links is not null

//creating an sql query
$sql = "insert into news (title,writer,content) values ('$title','$writer','$content')";
require_once('db_config.php');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die ("unable to connect");
//executing query to database
if(mysqli_query($con,$sql)){
    echo 'news added successfully';
    }else {
        echo 'could not add news';
        }

//clothing the database
mysqli_close($con);
}
