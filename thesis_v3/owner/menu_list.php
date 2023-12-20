<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Owner Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 10px;
            background-color: #f8f9fa;
        }

        @media (min-width: 768px) {
            body {
                margin-top: 10px;
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
            background-color: #343a40;
            z-index: 1;
            overflow-y: auto;
            transition: 0.5s;
            color: white;
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
            font-size: 24px;
        }

        #sidebar .menu-items {
            padding-top: 50px;
        }

        #content {
            margin-left: 0;
            transition: margin-left 0.5s;
            padding: 20px;
            position: relative;
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

        .profile-img-container {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: auto;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-details {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-details h2 {
            color: #007bff;
        }

        .user-details p {
            color: #6c757d;
        }

        .recent-activity {
            margin-top: 30px;
        }

        .activity-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .activity-card h4 {
            color: #343a40;
        }

        .activity-card p {
            color: #6c757d;
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

        .form-check-input:not(:checked)+.form-check-label {
            color: #868e96;
        }

        .form-check-input:not(:checked)+.form-check-label+.card {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar">
                <a href="#" class="close-btn" onclick="closeNav()">&times;</a>
                <div class="menu-items">
                    <div class="profile-img-container">
                        <img src="https://via.placeholder.com/150" alt="Profile" class="profile-img mx-auto d-block">
                    </div>
                    <div class="user-details">
                        <h2>John Doe</h2>
                        <p>Owner</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Manage Menu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
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
            <div class="container-fluid" id="content">
                <?php
                include '../include/db_connection.php';

                // Fetch user details
                // Assuming  the user details in the session
                $userName = "John Doe"; // Replace with actual user data
                $userRole = "Owner"; // Replace with actual user data
                ?>

                <div class="user-details">
                    <h2>Welcome, <?= $userName ?>!</h2>
                    <p>Manage your restaurant with ease.</p>
                </div>

                <div class="row recent-activity">
                    <div class="col-lg-4 col-md-6">
                        <div class="activity-card">
                            <h4>Recent Orders</h4>
                            <p>View and manage the latest orders placed by customers.</p>
                            <a href="#" class="btn btn-primary btn-sm">View Orders</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="activity-card">
                            <h4>Menu Overview</h4>
                            <p>Check and update your restaurant's menu items and categories.</p>
                            <a href="#" class="btn btn-primary btn-sm">Manage Menu</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="activity-card">
                            <h4>Analytics</h4>
                            <p>Track the performance of your restaurant with detailed analytics.</p>
                            <a href="#" class="btn btn-primary btn-sm">View Analytics</a>
                        </div>
                    </div>
                </div>

                <!-- Include the content of different menu categories -->
                <?php
                    include 'main_course_dish.php';
                    include 'appetizer_dish.php';
                    include 'desserts.php';
                    include 'drinks.php';
                ?>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        function openNav() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.add("opened");
            sidebar.style.width = "250px";
            document.getElementById("content").style.marginLeft = "250px";
            document.getElementById("sidebarCollapse").style.visibility = "hidden";
        }

        function closeNav() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.remove("opened");
            sidebar.style.width = "0";
            document.getElementById("content").style.marginLeft = "0";
            document.getElementById("sidebarCollapse").style.visibility = "visible";
        }

        function toggleNav() {
            var sidebar = document.getElementById("sidebar");
            if (sidebar.classList.contains("opened")) {
                closeNav();
            } else {
                openNav();
            }
        }

        document.getElementById("sidebarCollapse").addEventListener("click", function () {
            toggleNav();
        });

        if (window.innerWidth >= 768) {
            openNav();
        }
</script>



</body>

</html>
