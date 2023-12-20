<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = ''; 
$db_name = 'food_delivery_system_v1';

// Create a connection to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally set the character set to utf8
$conn->set_charset("utf8");
?>