<?php
$servername='mysql:host=localhost;dbname=leicesterCampusDB';
$username = 'root';
$password = 'root';
try{
    $conn = new PDO($servername,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "successfully";
}
catch (PDOException $e){
    echo "Connection failed" .$e->getMessage();
    }
?>
