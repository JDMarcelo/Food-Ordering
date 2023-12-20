<?php
include '../include/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Check if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $imagePath = 'uploads/'; // Your upload directory
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imagePath = $imagePath . $imageName;

        // Move the uploaded image to the specified directory
        if (move_uploaded_file($imageTmp, $imagePath)) {
            // Update data with the new image path
            $updateQuery = "UPDATE dishes SET name=?, price=?, description=?, category=?, image=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $updateQuery);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sdsssi", $name, $price, $description, $category, $imagePath, $id);
        } else {
            echo "File upload failed.";
            exit();
        }
    } else {
        // Update data without changing the image
        $updateQuery = "UPDATE dishes SET name=?, price=?, description=?, category=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sdssi", $name, $price, $description, $category, $id);
    }

    // Execute the prepared statement
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        // Redirect to the owner dashboard after updating
        header("Location: owner_dashboard.php");
        exit();
    } else {
        echo "Error updating dish: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
