<?php
$dbName = “leicesterCampusDB”;
$user = "root";
$pwd = “root”;
$host = "localhost";
$cnn = new PDO('mysql:dbname='.$dbName.';host='.$host, $user, $pwd);
