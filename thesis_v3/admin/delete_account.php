<?php
session_start();

// Include the database connection file
include('../include/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'id' parameter is set in the request
    if (isset($_POST['id'])) {
        $owner_id = $_POST['id'];

        // Assuming you have a database connection, adjust the query accordingly
        $delete_query = "DELETE FROM owners WHERE owner_id = ?";
        
        // Create a prepared statement
        $stmt = $conn->prepare($delete_query);

        // Bind the parameter
        $stmt->bind_param("i", $owner_id);

        // Execute the query
        $stmt->execute();

        // Close the statement
        $stmt->close();

        // Redirect to the admin dashboard or a confirmation page
        header("Location: ../admin/admin_dashboard.php");
        exit();
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
