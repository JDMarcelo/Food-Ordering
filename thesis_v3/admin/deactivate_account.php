<?php
session_start();

// Database connection code here
include('../include/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if 'id' parameter is set in the request
    if (isset($_GET['id'])) {
        $owner_id = $_GET['id'];

        // Assuming you have a database connection, adjust the query accordingly
        $update_query = "UPDATE owners SET approval_status = 'deactivated' WHERE owner_id = ?";
        
        // Create a prepared statement
        $stmt = $conn->prepare($update_query);

        // Bind the parameter
        $stmt->bind_param("i", $owner_id);

        // Execute the query
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();

            // Redirect to the admin dashboard or a confirmation page
            header("Location: ../admin/admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid request: 'id' parameter not set.";
        exit();
    }
} else {
    // Handle invalid requests
    echo "Invalid request method.";
    exit();
}
?>
