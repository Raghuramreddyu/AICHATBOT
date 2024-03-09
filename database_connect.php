<?php
$servername = 'localhost';
$username = 'root';
$password = '';


$conn = new mysqli($servername, $username, $password);

if($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
$sql = "CREATE DATABASE NLP";
if ($conn->query($sql) == true){
    echo("Database connected");
   
}
else{
("The database connected successfully");
}
?>