<?php
include '../include/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $newCategory = mysqli_real_escape_string($conn, $_POST['new_category']);

    // If a new category is provided, use it; otherwise, use the selected category
    $finalCategory = $newCategory ? $newCategory : $category;

    // Handle file upload
    $imagePath = 'uploads/'; // Create a folder named 'uploads' in your project directory
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = $imagePath . $imageName;

    if (move_uploaded_file($imageTmp, $imagePath)) {
        // File uploaded successfully, insert data into the database
        $insertQuery = "INSERT INTO dishes (name, price, description, category, image) 
                        VALUES ('$name', $price, '$description', '$finalCategory', '$imagePath')";
        
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            // Redirect to the owner dashboard
            header("Location: owner_dashboard.php");
            exit();
        } else {
            echo "Error adding product: " . mysqli_error($conn);
        }
    } else {
        echo "File upload failed.";
    }
}

mysqli_close($conn);
?>
