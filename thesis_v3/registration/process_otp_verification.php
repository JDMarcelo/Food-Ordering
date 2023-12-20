<?php
session_start();

// Include the database connection file
include('../include/db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = mysqli_real_escape_string($conn, $_POST['otp']);
    $user_id = $_SESSION['user_id']; // Assuming you have stored the user ID in the session during registration

    // Fetch the stored OTP from the database
    $otp_query = "SELECT captcha_code FROM owners WHERE owner_id = $user_id";
    $otp_result = mysqli_query($conn, $otp_query);

    if ($otp_result) {
        $user = mysqli_fetch_assoc($otp_result);
        $stored_otp = $user['captcha_code'];

        // Compare the entered OTP with the stored OTP
        if ($entered_otp == $stored_otp) {
            // Update the user's status to 'approved' (or any other status you prefer)
            $update_status_query = "UPDATE owners SET status = 'approved' WHERE owner_id = $user_id";
            $update_status_result = mysqli_query($conn, $update_status_query);

            if ($update_status_result) {
                // Successful OTP verification, redirect to the login page or dashboard
                $_SESSION['success'] = "OTP verification successful. You can now login.";
                header("Location: login.php");
                exit();
            } else {
                $errors['database_error'] = "Database error: " . mysqli_error($conn);
            }
        } else {
            $errors['otp_error'] = "Invalid OTP. Please try again.";
        }
    } else {
        $errors['database_error'] = "Database error: " . mysqli_error($conn);
    }
}

// If we reach here, there are errors
$response['errors'] = $errors ?? [];
echo json_encode($response);
?>
