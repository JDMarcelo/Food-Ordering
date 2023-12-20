<?php
// Include your database connection details
include '../includes/db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);

    // Placeholder for the image URL (replace with actual handling for file uploads)
    $image = '../image/image.jpg';

    // Insert data into the database
    $insertQuery = "INSERT INTO dishes (name, price, description, category, image) 
                    VALUES ('$name', $price, '$description', '$category', '$image')";

    $insertResult = mysqli_query($connection, $insertQuery);

    if ($insertResult) {
        echo "Dish added successfully.";
    } else {
        echo "Error adding dish: " . mysqli_error($connection);
    }
}

// Fetch menu items from the database
$selectQuery = "SELECT * FROM dishes"; // Corrected table name
$selectResult = mysqli_query($connection, $selectQuery);

// Check if there are menu items
if ($selectResult) {
    $dishes = mysqli_fetch_all($selectResult, MYSQLI_ASSOC);
} else {
    $dishes = [];
}

// Close the database connection
mysqli_close($connection);
?>
