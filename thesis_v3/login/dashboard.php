<?php
session_start();
// Include the database connection file
include('../include/db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $query = "SELECT * FROM owners WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the password is correct
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];

            // Check if 'role' column exists in your database
            if (isset($user['role'])) {
                $_SESSION['user_role'] = $user['role'];
            } else {
                // Set a default role if 'role' column doesn't exist
                $_SESSION['user_role'] = 'user';
            }

            // Redirect to the dashboard
            header("Location: ../login/dashboard.php");
            exit();
        } else {
            $loginError = "Invalid email or password";
        }
    } else {
        $loginError = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../ccs/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border p-3 shadow">
                    <h2 class="bg-success text-white p-2 rounded text-center">Admin Dashboard</h2>
                    <!-- Dashboard content goes here -->
                    <p>Welcome, <?php echo $_SESSION['user_role']; ?>!</p>
                    <a href="logout.php" class="btn btn-danger btn-block">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
