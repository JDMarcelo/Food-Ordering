<?php
session_start();

// Include the database connection file
include('../include/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'id' parameter is set in the request
    if (isset($_POST['id'])) {
        $owner_id = $_POST['id'];

        // Assuming you have a database connection, adjust the query accordingly
        $update_query = "UPDATE owners SET approval_status = 'approved' WHERE owner_id = ?";

        // Create a prepared statement
        $stmt = $conn->prepare($update_query);

        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $owner_id);

            // Execute the query
            $stmt->execute();

            // Close the statement
            $stmt->close();

            // Close the database connection
            $conn->close();

            // Redirect to the admin dashboard or a confirmation page
            header("Location: ../admin/admin_dashboard.php");
            exit();
        } else {
            // Handle statement preparation error
            echo "Error preparing statement.";
            exit();
        }
    } else {
        // Handle invalid request: 'id' parameter not set
        echo "Invalid request: 'id' parameter not set.";
        exit();
    }
} else {
    // Handle invalid requests
    echo "Invalid request method.";
    exit();
}
?>
