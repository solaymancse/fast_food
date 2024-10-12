<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <?php include('../config/db.php') ?>
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
                <div class="header-title">
                    <h1>Welcome Back</h1>
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
