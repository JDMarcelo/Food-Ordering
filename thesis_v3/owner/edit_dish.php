<?php
include '../include/db_connection.php';

// Check if the dish ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch dish information
    $query = "SELECT * FROM dishes WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $dish = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching dish: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Dish ID is not provided.";
    exit();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Dish</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Dish</h1>

        <?php
        include '../include/db_connection.php';

        // Check if the dish ID is provided in the URL
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            // Fetch the dish details based on the ID
            $query = "SELECT * FROM dishes WHERE id=$id";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $dish = mysqli_fetch_assoc($result);
            } else {
                echo "Error fetching dish: " . mysqli_error($conn);
                exit();
            }
        } else {
            echo "Dish ID not provided.";
            exit();
        }
        ?>

        <form action="process_edit_dish.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $dish['id'] ?>">

            <div class="form-group">
                <label for="name">Dish Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $dish['name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $dish['price'] ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?= $dish['description'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="<?= $dish['category'] ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Change Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Update Dish</button>
        </form>
    </div>
</body>
</html>
