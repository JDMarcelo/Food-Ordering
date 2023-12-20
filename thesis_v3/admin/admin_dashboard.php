<?php
// Include the database connection file
include('../include/db_connection.php');

// Fetch all registrations
$query = "SELECT * FROM owners";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome CSS (Make sure to include the CSS link in your head section) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-fluid {
            margin-top: 20px;
        }

        .jumbotron {
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #007bff;
            border-radius: 0.3rem;
            color: #fff;
        }

        .jumbotron h1 {
            font-size: 2.5rem;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            padding-left: 10px;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .sidebar a {
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            margin-bottom: 10px;
        }

        .ellipsis {
            cursor: pointer;
        }

        .table th,
        .table td {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                <div class="sidebar-sticky">
                    <h5>Menu</h5>
                    <a href="#">Dashboard</a>
                    <a href="#">Users</a>
                    <a href="#">Settings</a>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Admin Dashboard</h1>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['owner_id']}</td>";
                                echo "<td>{$row['last_name']}</td>";
                                echo "<td>{$row['first_name']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['approval_status']}</td>";
                                echo "<td>";

                                // Display icon for actions with collapse
                                echo "<i class='fas fa-cogs text-primary action-icon' data-toggle='collapse' href='#actionsCollapse_{$row['owner_id']}' role='button' aria-expanded='false' aria-controls='actionsCollapse_{$row['owner_id']}'></i>";

                                // Collapsible section for actions
                                echo "<div class='collapse' id='actionsCollapse_{$row['owner_id']}'>";
                                echo "<div class='card card-body bg-transparent '>";

                                // Approval action
                                echo "<form id='approveForm_{$row['owner_id']}' action='../admin/approve_registration.php' method='post'>";
                                echo "<input type='hidden' name='id' value='{$row['owner_id']}'>";
                                echo "<a href='javascript:void(0);' onclick=\"document.getElementById('approveForm_{$row['owner_id']}').submit();\">Approve</a>";
                                echo "</form>";

                                // Deactivate action
                                if ($row['approval_status'] == 'approved' || $row['approval_status'] == 'deactivated' || $row['approval_status'] == 'pending') {
                                    echo "<a href='../admin/deactivate_account.php?id={$row['owner_id']}' onclick='return confirm(\"Are you sure you want to deactivate?\")'>Deactivate</a>";
                                }

                                // Delete action
                                echo "<form id='deleteForm_{$row['owner_id']}' action='../admin/delete_account.php' method='post'>";
                                echo "<input type='hidden' name='id' value='{$row['owner_id']}'>";
                                echo "<a href='javascript:void(0);' onclick=\"if(confirm('Are you sure you want to delete?')) document.getElementById('deleteForm_{$row['owner_id']}').submit();\">Delete</a>";
                                echo "</form>";

                                echo "</div>";
                                echo "</div>";

                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (Include jQuery before Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>