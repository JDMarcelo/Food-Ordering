<?php
include '../include/db_connection.php';

if (isset($_GET['id'])) {
    $dishId = $_GET['id'];

    if (isset($_POST['deleteConfirmed'])) {
        $deleteQuery = "DELETE FROM dishes WHERE id = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $dishId);
            mysqli_stmt_execute($stmt);

            header("Location: owner_dashboard.php");
            exit;
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }
} else {
    echo "Dish ID is not provided.";
}

mysqli_close($conn);
?>
