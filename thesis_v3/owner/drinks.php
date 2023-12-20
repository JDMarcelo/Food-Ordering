<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Owner Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
            /* Adjust the top padding for larger screens */
        }

        @media (min-width: 768px) {
            body {
                padding-top: 56px;
                /* Adjust the top padding for larger screens */
            }

            #sidebar {
                width: 250px;
            }

            #content {
                margin-left: 250px;
            }
        }

        #sidebar {
            position: fixed;
            width: 0;
            height: 100vh;
            top: 0;
            left: 0;
            background-color: #111;
            z-index: 1;
            overflow-y: auto;
            transition: 0.5s;
        }

        #sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
            margin-top: 10px;
        }

        #sidebar a:hover {
            color: #f1f1f1;
        }

        #sidebar .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 36px;
            margin-left: 50px;
        }

        #sidebar .menu-items {
            padding-top: 50px;
        }

        #content {
            margin-left: 0;
            transition: margin-left 0.5s;
            padding: 20px;
        }

        #sidebarCollapse {
            position: fixed;
            top: 10px;
            left: 10px;
            cursor: pointer;
            z-index: 1001;
            color: black;
            padding: 8px 10px;
            border-radius: 3px;
        }

        #sidebarCollapse:hover {
            background-color: #777;
        }

        .burger-icon {
            width: 30px;
            height: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            padding: 5px;
            border-radius: 3px;
            color: black;
        }

        .burger-icon div {
            width: 100%;
            height: 3px;
            transition: 0.4s;
            background-color: black;
        }

        .card-img-top {
            max-width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .btn-primary,
        .btn-danger {
            width: 100%;
            margin-top: 10px;
        }

        /* Style for unchecked checkbox and disabled card */
        .form-check-input:not(:checked)+.form-check-label {
            color: #868e96;
            /* Text color for disabled look */
        }

        .form-check-input:not(:checked)+.form-check-label+.card {
            opacity: 0.6;
            /* Adjust the opacity for the disabled look */
            pointer-events: none;
            /* Disable pointer events for the card */
        }
    </style>
</head>

<body>

<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar">
                <a href="#" class="close-btn" onclick="closeNav()">&times;</a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                                <a class="nav-link active" href="owner_dashboard.php">
                                    Dashboard
                                </a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#categoryCollapse">
                                    Category <span class="collapse-icon">&#9662;</span>
                                </a>
                                <ul class="nav flex-column ml-3 collapse" id="categoryCollapse">
                                    <li class="nav-item">
                                        <a class="nav-link" href="main_course_dish.php">
                                            Main Course
                                        </a>
                                    </li>
                                    <li class="nav-item">   
                                        <a class="nav-link" href="appetizer_dish.php">
                                            Appetizer
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="desserts.php">
                                            Dessert
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="drinks.php">
                                                Drinks
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="openAddProductModal()">
                                    Add Dishes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../login/login_form.php">
                                    Logout
                                </a>
                            </li>
                        <!-- Add more sidebar options as needed -->
                    </ul>
            </nav>


            <!-- Toggle Button -->
            <div id="sidebarCollapse">
                <div class="burger-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>

            <!-- Main Content -->
            <main role="main" class="col-md-12" id="content">
                <h1 class="text-center mb-4">Drinks</h1>
                <div class="row">
                    <?php
                    include '../include/db_connection.php';

                    if (isset($_GET['category'])) {
                        $category = mysqli_real_escape_string($conn, $_GET['category']);
                        $query = "SELECT * FROM dishes WHERE category = '$category' AND category = 'drinks'";
                    } else {
                        $query = "SELECT * FROM dishes WHERE category = 'drinks'";
                    }

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($dish = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="<?= $dish['image'] ?>" class="card-img-top" alt="<?= $dish['name'] ?>">
                                    <div class="card-body">
                                        <!-- End Checkbox -->
                                        <h5 class="card-title">
                                            <?= $dish['name'] ?>
                                        </h5>
                                        <p class="card-text">
                                            <?= $dish['description'] ?>
                                        </p>
                                        <p class="card-text"><strong>Price:</strong> ₱
                                            <?= $dish['price'] ?>
                                        </p>
                                        <p class="card-text"><strong>Category:</strong>
                                            <?= $dish['category'] ?>
                                        </p>
                                        <p class="card-text"><strong>Time Added:</strong>
                                            <?= date('F j, Y, g:i a', strtotime($dish['timestamp_column'])) ?>
                                        </p>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="availabilityCheck<?= $dish['id'] ?>" <?= isset($dish['is_available']) ? ($dish['is_available'] ? 'checked' : '') : 'checked' ?>>
                                            <label class="form-check-label" for="availabilityCheck<?= $dish['id'] ?>">Available
                                                for Menu</label>
                                        </div>
                                        <div class="text-right">
                                                <a href="javascript:void(0)" class="btn btn-primary editDishLink" data-dish-id="<?= $dish['id'] ?>" onclick="openEditDishModal(<?= $dish['id'] ?>)">Edit</a>
                                                <a href="javascript:void(0);" class="btn btn-danger" onclick="openDeleteConfirmationModal(<?= $dish['id'] ?>)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                               <!-- Delete Confirmation Modal -->
                               <div class="modal fade" id="deleteConfirmationModal<?= $dish['id'] ?>" tabindex="-1" role="dialog"
                                aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this dish?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Form for delete confirmation -->
                                            <form method="post" action="delete_dish.php?id=<?= $dish['id'] ?>">
                                                <input type="hidden" name="deleteConfirmed" value="1">
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                             <!-- Edit Dish Modal -->
                                <div class="modal editDishModal" id="editDishModal<?= $dish['id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Dish</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Form for editing a dish -->
                                                <form action="process_edit_dish.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $dish['id'] ?>">

                                                    <div class="form-group">
                                                        <label for="editName<?= $dish['id'] ?>">Dish Name:</label>
                                                        <input type="text" class="form-control" id="editName<?= $dish['id'] ?>" name="name" value="<?= $dish['name'] ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editPrice<?= $dish['id'] ?>">Price:</label>
                                                        <input type="number" class="form-control" id="editPrice<?= $dish['id'] ?>" name="price" value="<?= $dish['price'] ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editDescription<?= $dish['id'] ?>">Description:</label>
                                                        <textarea class="form-control" id="editDescription<?= $dish['id'] ?>" name="description" required><?= $dish['description'] ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editCategory<?= $dish['id'] ?>">Category:</label>
                                                        <input type="text" class="form-control" id="editCategory<?= $dish['id'] ?>" name="category" value="<?= $dish['category'] ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editImage<?= $dish['id'] ?>">Change Image:</label>
                                                        <input type="file" class="form-control-file" id="editImage<?= $dish['id'] ?>" name="image" accept="image/*">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-block">Update Dish</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    } else {
                        echo "Error fetching dishes: " . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                    ?>

                </div>
            </main>
        </div>
    </div>
      <!-- Add Product Modal -->
      <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding a product -->
                            <form action="process_add_product.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="productName">Product Name:</label>
                                    <input type="text" class="form-control" id="productName" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="productPrice">Price:</label>
                                    <input type="number" class="form-control" id="productPrice" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="productDescription">Description:</label>
                                    <textarea class="form-control" id="productDescription" name="description" required></textarea>
                                </div>

                                <!-- select category -->
                                <div class="form-group">
                                    <label for="productCategory">Category:</label>
                                    <select class="form-control" id="productCategory" name="category">
                                        <option value="">Select Category</option>
                                        <option value="Appetizer">Appetizer</option>
                                        <option value="Dessert">Dessert</option>
                                        <option value="Drinks">Drinks</option>
                                        <option value="Main Course">Main Course</option>
                                        <!-- Add other categories from the database here -->
                                    </select>
                                </div>

                                <!-- New category input field -->
                                <div class="form-group">
                                    <label for="newCategory">Add Other Category:</label>
                                    <input type="text" class="form-control" id="newCategory" name="new_category">
                                </div>
                                
                                <div class="form-group">
                                    <label for="productImage">Image Upload:</label>
                                    <input type="file" class="form-control-file" id="productImage" name="image" accept="image/*" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function openNav() {
            document.getElementById("sidebar").style.width = "250px";
            document.getElementById("content").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("content").style.marginLeft = "0";
            document.getElementById("sidebarCollapse").style.display = "block";
        }

        function toggleNav() {
            var sidebarWidth = document.getElementById("sidebar").style.width;
            if (sidebarWidth === "250px") {
                closeNav();
            } else {
                openNav();
            }
        }

        document.getElementById("sidebarCollapse").addEventListener("click", function () {
            toggleNav();
        });

        // Ensure the sidebar is open by default on larger screens
        if (window.innerWidth >= 768) {
            openNav();
        }
          // Function to open the modal for adding a product
          function openAddProductModal() {
            $('#addProductModal').modal('show');
        }
        function openDeleteConfirmationModal(id) {
            $('#deleteConfirmationModal' + id).modal('show');
        }
        // Function to open the modal for editing a dish
        function openEditDishModal(dishId) {
            $('#editDishModal' + dishId).modal('show');
        }
    </script>
</body>

</html>
