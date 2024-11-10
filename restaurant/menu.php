<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../restaurant_login.php");
    exit();
}

include('../config/db.php');
include('./create_menu.php');

$restaurant_id = $_SESSION['user_id'];

// Process form submission
if (isset($_POST['submit'])) {
    // Get form data
    $food_name = $_POST['name'];
    $price = $_POST['price'];
    $status = $_POST['status'];


    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $upload_dir = 'uploads/';
        $upload_path = $upload_dir . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
        } else {
            echo "Error uploading image.";
        }
    }

    // Insert the new order into the database
    $sql = "INSERT INTO menus (restaurant_id, image, name, price, status) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issss", $restaurant_id, $image, $food_name, $price, $status);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "New menu item created successfully.";
        $_SESSION['msg_type'] = "success";
        header("Location: ./menu_list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased h-screen flex">

    <!-- Sidebar -->
    <?php @include('./sidebar.php'); ?>

    <!-- Main Content Area -->
    <main class="w-full h-full bg-white pt-20">
        <?php
        if (isset($_SESSION['message'])) {
            $message_type = $_SESSION['msg_type'] === "success" ? "bg-green-500" : "bg-red-500";
            echo '<div class="alert ' . $message_type . ' text-white font-bold rounded-lg px-4 py-2 mb-4" role="alert">
                        ' . $_SESSION['message'] . '
                        <button onclick="this.parentElement.style.display=\'none\'" class="float-right ml-2 text-white" aria-label="Close">&times;</button>
                    </div>';
            unset($_SESSION['message']);
        }
        ?>
        <form action="" method="post" class="w-full max-w-sm" enctype="multipart/form-data">
            <!-- Food Image -->
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-2/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="image">
                        Food Image
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="image" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="file" required>
                </div>
            </div>

            <!-- Food Name -->
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-2/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                        Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" required>
                </div>
            </div>

            <!-- Price -->
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-2/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="price">
                        Price
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input name="price" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" required>
                </div>
            </div>

            <!-- Status -->
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-2/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="status">
                        Status
                    </label>
                </div>
                <div class="md:w-2/3">
                    <select name="status" id="status" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" required>
                        <option value="available">Available</option>
                        <option value="not available">Not Available</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="w-full">
                    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" name="submit">
                        Set Menu
                    </button>
                </div>
            </div>
        </form>
    </main>

</body>

</html>