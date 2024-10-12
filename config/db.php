<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database already exists
$db_check = $conn->select_db("fast_food");

if ($db_check) {
} else {
    // Create the database since it doesn't exist
    $sql = "CREATE DATABASE fast_food";

    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}

