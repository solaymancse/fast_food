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
$tableExists = $conn->query("SHOW TABLES LIKE 'menus'")->num_rows > 0;

if (!$tableExists) {
    // SQL to create table
    $sql = "CREATE TABLE menus (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         restaurant_id INT UNSIGNED,
        image VARCHAR(30) NULL,
        name VARCHAR(30) NOT NULL,
        price VARCHAR(30) NOT NULL,
        status VARCHAR(50) default 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE
        
    )";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
}
