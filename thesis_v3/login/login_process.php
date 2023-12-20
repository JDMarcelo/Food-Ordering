<?php
// login_process.php

session_start();

// Use the __DIR__ constant to get the absolute path of the current file's directory
include(__DIR__ . '/../include/db_connection.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM owners WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: ../login/dashboard.php");
            exit();
        } else {
            $loginError = "Invalid email or password";
        }
    } else {
        $loginError = "Invalid email or password";
    }

    $stmt->close();
    $conn->close();
}
?>
