<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NLP";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $query = "SELECT id, email, pass FROM chatbot WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['pass'])) {
                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['expire_time'] = time() + 5; // 5 seconds

                    // Redirect to index1.html
                    header("Location: index1.html");
                    exit();
                } else {
                    echo "Incorrect password";
                }
            } else {
                echo "User not found";
            }
        }
    }
}

mysqli_close($con);
?>
