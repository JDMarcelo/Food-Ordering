<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Owner Account Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Navbar styles */
        nav.navbar {
            background-color: #007bff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav.navbar a {
            color: #ffffff;
        }

        nav.navbar i {
            font-size: 20px;
        }

        /* Sidebar styles */
        #sidebar {
            background-color: #343a40;
            color: #ffffff;
            height: 100vh;
            transition: all 0.3s;
            position: fixed;
            z-index: 1;
            overflow: hidden;
            padding-top: 20px;
        }

        #sidebar a {
            padding: 10px;
            font-size: 18px;
            transition: 0.3s;
            color: #ffffff;
        }

        #sidebar a:hover {
            color: #007bff;
            background: rgba(255, 255, 255, 0.1);
        }

        #sidebar .active {
            background-color: #007bff;
        }

        #sidebarCollapse {
            cursor: pointer;
        }

        /* Content styles */
        #content {
            transition: margin-left 0.3s;
            padding: 20px;
            overflow-x: hidden;
            margin-left: 250px;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #content {
                margin-left: 0;
            }

            #sidebar.opened {
                margin-left: 0;
            }
        }

        /* Improved Container Styles */
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        h2 {
            color: #007bff;
        }

        /* Custom Settings */
        #customSettings {
            margin-top: 20px;
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button id="sidebarCollapse" class="btn btn-link text-white">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">Owner Dashboard</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('accountProfile')">
                                <i class="fas fa-user"></i> Account Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" onclick="showContent('settings')">
                                <i class="fas fa-cogs"></i> Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('changePassword')">
                                <i class="fas fa-key"></i> Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('changeTheme')">
                                <i class="fas fa-paint-brush"></i> Change Theme
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('paymentMethods')">
                                <i class="fas fa-coins"></i> Payment Methods
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="content">
                <div class="container" id="accountProfile">
                    <!-- Account Profile Content -->
                    <h2>Account Profile</h2>
                    <div id="accountProfileContent">
                        <!-- Your account profile content goes here -->
                        <p>Welcome to your account profile!</p>
                    </div>
                </div>

                <div class="container d-none" id="settings">
                    <!-- Settings Content -->
                    <h2>Settings</h2>

                    <!-- Change Password -->
                    <div id="changePassword" class="container mt-2">
                        <h3>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseChangePassword" aria-expanded="false" aria-controls="collapseChangePassword">
                                Change Password
                            </button>
                        </h3>
                        <div class="collapse" id="collapseChangePassword">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password:</label>
                                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password:</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password:</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>
                    </div>

                    <!-- Change Theme -->
                    <div id="changeTheme" class="container mt-2">
                        <h3>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseChangeTheme" aria-expanded="false" aria-controls="collapseChangeTheme">
                                Change Theme
                            </button>
                        </h3>
                        <div class="collapse" id="collapseChangeTheme">
                            <!-- Include your theme change options here -->
                            <!-- For example: Light/Dark theme switch -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="themeSwitch" name="themeSwitch">
                                <label class="form-check-label" for="themeSwitch">Dark Mode</label>
                            </div>
                            <button type="button" class="btn btn-primary">Save Theme</button>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div id="paymentMethods" class="container mt-2">
                        <h3>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsePaymentMethods" aria-expanded="false" aria-controls="collapsePaymentMethods">
                                Payment Methods
                            </button>
                        </h3>
                        <div class="collapse" id="collapsePaymentMethods">
                            <form action="#" method="post">
                                <!-- List of existing payment methods -->
                                <div class="form-group">
                                    <label>Existing Payment Methods:</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="creditCard" name="paymentMethods[]" value="creditCard" checked>
                                        <label class="form-check-label" for="creditCard">Credit Card</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="paypal" name="paymentMethods[]" value="paypal" checked>
                                        <label class="form-check-label" for="paypal">PayPal</label>
                                    </div>
                                    <!-- Add more existing payment methods as needed -->
                                </div>

                                <!-- Add new payment method -->
                                <div class="form-group mt-3">
                                    <label for="newPaymentMethod">Add New Payment Method:</label>
                                    <input type="text" class="form-control" id="newPaymentMethod" name="newPaymentMethod">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Payment Method</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("opened", !sidebar.classList.contains("opened"));
    }

    function showContent(contentId) {
        // Hide all content containers
        var contentContainers = document.querySelectorAll(".container");
        contentContainers.forEach(function (container) {
            container.classList.add("d-none");
        });

        // Show the selected content container
        var selectedContent = document.getElementById(contentId);
        if (selectedContent) {
            selectedContent.classList.remove("d-none");
        }
    }

    // Event listener for the sidebar toggle button
    document.getElementById("sidebarCollapse").addEventListener("click", function () {
        toggleSidebar();
    });

    // Close sidebar on click outside (for better user experience)
    document.addEventListener("click", function (event) {
        var sidebar = document.getElementById("sidebar");
        if (event.target.closest("#sidebar") === null && sidebar.classList.contains("opened")) {
            toggleSidebar();
        }
    });

    // Set the initial content to be displayed (for example, the account profile)
    showContent('accountProfile');

    // Add the 'active' class to the 'Account Profile' link
    document.addEventListener("DOMContentLoaded", function() {
        var accountProfileLink = document.querySelector('.nav-link[href="#"]:first-child');
        if (accountProfileLink) {
            accountProfileLink.classList.add('active');
        }
    });
</script>

</body>

</html>
