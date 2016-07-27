<?php
$con = mysqli_connect("localhost:3306","root","root");
$sql = "CREATE DATABASE leicesterCampus";
if (mysqli_query($con,$sql))
{
    echo "database leicesterCampus created successfully";
}

//creating tables
$sqlTable = "CREATE table userInfo
    (
        Username varchar(30),
        Password varchar(30),
        Role varchar(30)
    )";

if(mysqli_query($con,$sqlTable))
{
    echo "Table userInfo have been created successfully";
}

//insert value into tables
//
?>
