<?php
session_start();

// Database connection code here
include('../include/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $age = $_POST['age'];
    $store_address = $_POST['store_address'];
    $owner_address_street_number = $_POST['owner_address_street_number'];
    $owner_address_barangay = $_POST['owner_address_barangay'];
    $owner_address_municipality = $_POST['owner_address_municipality']; // Added line
    $owner_address_city = $_POST['owner_address_city']; // Added line
    $owner_address_province = $_POST['owner_address_province']; // Added line
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    //newly added by ferds 1:50pm 12/17/2023
   // $otp = $_POST['otp'];

    // Perform validation
    $errors = [];

    $email = $_POST['email']; // Add this line to properly assign $email
    $password = $_POST['password']; // Add this line to properly assign $password

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Validate password length
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    }

    // Validate password match
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        $errors['passwordMatch'] = "Passwords do not match";
    }

    // Check if there are any validation errors
    if (!empty($errors)) {
        // Respond with errors
        echo json_encode(['errors' => $errors]);
        exit();
    }

    // Assuming you have a database connection, adjust the query accordingly
    $query = "INSERT INTO owners (last_name, first_name, middle_name, age, store_address, owner_address_street_number, owner_address_barangay, owner_address_municipality, owner_address_city, owner_address_province, email, phone_number, password, approval_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

    // Create a prepared statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bind_param("sssisssssssss", $last_name, $first_name, $middle_name, $age, $store_address, $owner_address_street_number, $owner_address_barangay, $owner_address_municipality, $owner_address_city, $owner_address_province, $email, $phone_number, $password);

 
    // Execute the query
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Respond with success
    echo json_encode(['success' => true]);
    exit();
} else {
    // Handle invalid requests
    echo json_encode(['error' => 'Invalid request.']);
    exit();
}
?>