<?php
$serverName="localhost";
$userName="root";
$passWord="";
$dbName="vehicle";

$conn = new mysqli($serverName,$userName,$passWord,$dbName);

if($conn->connect_error){
    die("Connection failed:" . $conn->connection_error);
}

?>
