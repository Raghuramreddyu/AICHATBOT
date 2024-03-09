<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'NLP';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection to database failed' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $user_email = $_POST['email'];
        $user_pass = $_POST['password'];
        $password_hash = password_hash($user_pass, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM chatbot WHERE email = '$user_email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "User Exists";
        } else {
            $stmt = $conn->prepare("INSERT INTO chatbot (firstname, lastname, email, pass) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fname, $lname, $user_email, $password_hash);
            $stmt->execute();

            echo "New user created successfully";

            setcookie("user_email", $user_email, time() + (86400 * 30), "/"); 

            session_start();
            $_SESSION['user_email'] = $user_email;
            $_SESSION['expire_time'] = time() + 10; 

            if (isset($_COOKIE['user_email'])) {
                echo "<br>Cookies are stored";
            } else {
                echo "<br>Cookies are not stored";
            }

            $stmt->close();

            // Redirect to index1.html
            header("Location: index1.html");
            exit();
        }
    } else {
        echo "Incomplete form submission";
    }
}

$conn->close();

?>
