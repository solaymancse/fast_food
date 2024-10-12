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
$tableExists = $conn->query("SHOW TABLES LIKE 'restaurant'")->num_rows > 0;

if (!$tableExists) {
    // SQL to create table
    $sql = "CREATE TABLE restaurant (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        phone VARCHAR(50),
        location VARCHAR(50),
        status VARCHAR(50)
    )";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
}

?>
