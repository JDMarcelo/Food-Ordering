<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px #000000;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #007bff;
        }

        label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-2">
        <h1 class="text-center mb-4">Add Product</h1>
        <form action="../owner/process_add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Main Course">Main Course</option>
                    
                    
                    <!-- Add more categories as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image Upload:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
            <a href="owner_dashboard.php" class="btn btn-link">Go to Owner Dashboard</a>
        </form>
    </div>
</body>

</html>