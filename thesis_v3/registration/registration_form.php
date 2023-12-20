<?php
// Include the database connection file
include('../include/db_connection.php');

// Fetch all registrations
$query = "SELECT * FROM owners";
$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../ccs/bootstrap.min.css">
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
</script>
    <script type="text/javascript">
   (function(){
      emailjs.init("dTFun6I4WrFIdswwA");
   })();
</script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border p-3 shadow">
                    <h2 class="bg-primary text-white p-2 rounded text-center">User Registration</h2>
                    <form action="../registration/process_registration.php" method="post">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>

                        <div class="form-group">
                            <label for="middle_name">Middle Name:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>

                        <div class="form-group">
                            <label for="store_address">Store Address (Google Maps):</label>
                            <input type="text" class="form-control" id="store_address" name="store_address" required>
                        </div>

                        <div class="form-group">
                            <label for="owner_address_street_number">Owner Address - Street Number:</label>
                            <input type="text" class="form-control" id="owner_address_street_number"
                                name="owner_address_street_number">
                        </div>

                        <div class="form-group">
                            <label for="owner_address_barangay">Owner Address - Barangay:</label>
                            <input type="text" class="form-control" id="owner_address_barangay"
                                name="owner_address_barangay">
                        </div>

                        <div class="form-group">
                            <label for="owner_address_municipality">Owner Address - Municipality:</label>
                            <input type="text" class="form-control" id="owner_address_municipality"
                                name="owner_address_municipality">
                        </div>

                        <div class="form-group">
                            <label for="owner_address_city">Owner Address - City:</label>
                            <input type="text" class="form-control" id="owner_address_city" name="owner_address_city">
                        </div>

                        <div class="form-group">
                            <label for="owner_address_province">Owner Address - Province:</label>
                            <input type="text" class="form-control" id="owner_address_province"
                                name="owner_address_province">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required
                                pattern="^(09)\d{9}$" title="Invalid phone number format">
                            <small id="phone_numberError" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small id="emailError" class="text-danger">
                                <?php echo isset($errors['email']) ? $errors['email'] : ''; ?>
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small id="passwordError" class="text-danger">
                                <?php echo isset($errors['password']) ? $errors['password'] : ''; ?>
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            <small id="passwordMatchError" class="text-danger d-none">Passwords do not match</small>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfM1DApAAAAAI1zEK-G9z-OVD_zUFR9m-MPbnOb"></div>
                        </div>
                        <!-- Display errors -->
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>


                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (Include jQuery before Bootstrap JS) -->
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                document.getElementById("passwordMatchError").classList.remove("d-none");
                return false;
            } else {
                document.getElementById("passwordMatchError").classList.add("d-none");
                return true;
            }
        }
    </script>
    
    <script src="registration_form.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
</body>

</html>