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
    // Note: In a real-world scenario, handle file uploads securely. Below is a placeholder for the image URL.
    $image = '../image/image.jpg'; // Change this if you're handling file uploads

    // Insert data into the database
    $query = "INSERT INTO dishes (name, price, description, category, image) 
              VALUES ('$name', $price, '$description', '$category', '$image')";
    
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Dish added successfully.";
    } else {
        echo "Error adding dish: " . mysqli_error($connection);
    }
}

// Fetch menu items from the database
$query = "SELECT * FROM dishes";  // Corrected table name
$result = mysqli_query($connection, $query);

// Check if there are menu items
if ($result) {
    $dishes = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $dishes = [];
}

// Close the database connection
mysqli_close($connection);
?>
