<?php

$servername= 'localhost';
$username= 'root';
$password='';
$dbname='NLP';
$conn= new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die('Connection to database failed'. $conn->connect_error);
}

$sql = "INSERT INTO chatbot(firstname,lastname,email,pass) VALUES  ( 'RAGHU','UMMADI','raghu@gmail.com','r@1223')";
if($conn->query($sql)===true){
    echo("Values Created Successfully");
}else{
    echo("Values not created");
}
?>