<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Fast Food</title>

    <?php
    include('../config/db.php');

    $adminCount = 0;
    $customerCount = 0;
    $restaurantCount = 0;
    $activeRestaurantCount = 0;

    $adminQuery = "SELECT COUNT(*) AS total_admins FROM admins";
    $adminResult = $conn->query($adminQuery);
    if ($adminResult) {
        $adminRow = $adminResult->fetch_assoc();
        $adminCount = $adminRow['total_admins'];
    }

    $customerQuery = "SELECT COUNT(*) AS total_customers FROM customers";
    $customerResult = $conn->query($customerQuery);
    if ($customerResult) {
        $customerRow = $customerResult->fetch_assoc();
        $customerCount = $customerRow['total_customers'];
    }

    $tableCheckQuery = "SHOW TABLES LIKE 'restaurant'";
    $tableCheckResult = $conn->query($tableCheckQuery);

    if (mysqli_num_rows($tableCheckResult) > 0) {
        $restaurantQuery = "SELECT COUNT(*) AS total_restaurants FROM restaurant";
        $restaurantResult = $conn->query($restaurantQuery);
        if ($restaurantResult) {
            $restaurantRow = $restaurantResult->fetch_assoc();
            $restaurantCount = $restaurantRow['total_restaurants'];

            $activeRestaurantQuery = "SELECT COUNT(*) AS active_restaurants FROM restaurant WHERE status = 1 ";
            $activeRestaurantResult = $conn->query($activeRestaurantQuery);
            if ($activeRestaurantResult) {
                $activeRestaurantRow = $activeRestaurantResult->fetch_assoc();
                $activeRestaurantCount = $activeRestaurantRow['active_restaurants'];
            }
        }
    } else {
    }




    ?>
</head>

<body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    <?php include('sidebar.php'); ?>
    <div class="main-content">
        <header>
            <div class="header-wrapper">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                <!-- <div class="header-title">
                    <h1>Welcome Back</h1>
                </div> -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Sample Card 1 -->
                    <div class="p-4 text-center bg-white rounded-lg shadow">
                        <h2 class=" text-gray-60 mb-2">Total Admin</h2>
                        <p class="text-3xl  text-gray-600  font-bold"><?php echo $adminCount; ?></p>
                    </div>

                    <div class="p-4 text-center bg-white rounded-lg shadow">
                        <h2 class=" text-gray-60 mb-2">Total Customer</h2>
                        <p class="text-3xl  text-gray-600  font-bold"><?php echo $customerCount; ?></p>
                    </div>
                    <!-- Sample Card 2 -->
                    <div class="p-4 text-center bg-white rounded-lg shadow">
                        <h2 class="text-gray-60 mb-2">Registered Restaurant</h2>
                        <p class="text-3xl text-gray-600 font-bold"><?php echo $restaurantCount; ?></p>
                    </div>
                    <!-- Sample Card 3 -->
                    <div class="p-4 text-center bg-white rounded-lg shadow">
                        <h2 class="text-gray-60 mb-2">Active Restaurant</h2>
                        <p class="text-3xl text-gray-600 font-bold"><?php echo $activeRestaurantCount; ?></p>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <?php
            // Get the requested page from the URL, default to 'dashboard'
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
            $pagePath = "dashboard/{$page}.php"; // Path to the page files

            // Check if the requested page exists
            if (file_exists($pagePath)) {
                include($pagePath);
            } else {
                // Optionally include a 404 page or a default page
                include("404.php");
            }
            ?>
        </main>
    </div>

    <script src="./script.js"></script>
</body>

</html>