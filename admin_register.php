<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fast_food";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the table exists
$tableExists = $conn->query("SHOW TABLES LIKE 'admins'")->num_rows > 0;

if (!$tableExists) {
    // SQL to create table
    $sql = "CREATE TABLE admins (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(20) NOT NULL DEFAULT 'admin',
        status VARCHAR(50) NULL
    )";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
}

$superAdminExists = $conn->query("SELECT * FROM admins WHERE role = 'super_admin'")->num_rows > 0;

if (!$superAdminExists) {
    // Insert a super admin with predefined credentials
    $superAdminName = "Super Admin";
    $superAdminEmail = "admin@gmail.com";
    $superAdminPassword = password_hash("12345", PASSWORD_DEFAULT);

    $sql = "INSERT INTO admins (name, email, password, role, status) VALUES ('$superAdminName', '$superAdminEmail', '$superAdminPassword', 'super_admin', 'active')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error inserting super admin: " . $conn->error;
    }
}
