<?php
session_start();
include '../connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM notice WHERE id= '$id'";


$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['data'] = "Notice Deleted successful";
    header("Location: all_notice.php");
} else {
    echo "Failed: " . mysqli_error($conn);
}
