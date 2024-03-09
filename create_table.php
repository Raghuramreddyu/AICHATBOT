<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'NLP';

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS chatbot (
    ID INT(6) AUTO_INCREMENT PRIMARY KEY,
    FIRSTNAME VARCHAR(30) NOT NULL,
    LASTNAME VARCHAR(30),
    EMAIL VARCHAR(100) NOT NULL,
    PASS VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === true) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
