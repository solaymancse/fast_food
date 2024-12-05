<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle logout if the form is submitted
if (isset($_POST['logout'])) {
    // Clear session data
    session_unset();
    session_destroy();

    // Redirect to the login or home page
    header("Location: ../index.php");
    exit();
}
?>

<aside class="w-64 bg-blue-800 text-white flex flex-col">
    <div class="px-6 py-4 text-2xl font-bold">
        Dashboard
    </div>
    <nav class="flex-1 px-6 space-y-2">
        <a href="./dashboard.php" class="block py-2 px-4 rounded-md hover:bg-blue-700">Home</a>
        <a href="./menu.php" class="block py-2 px-4 rounded-md hover:bg-blue-700">Add Menu</a>
        <a href="./menu_list.php" class="block py-2 px-4 rounded-md hover:bg-blue-700">Menu List</a>
        <a href="./order_list.php" class="block py-2 px-4 rounded-md hover:bg-blue-700">Order List</a>
    </nav>
    <form action="" method="POST" class="p-6 ">
        <button type="submit" name="logout" class="block text-center py-2 px-4 rounded-md bg-red-600 hover:bg-red-600">
            Logout
        </button>
    </form>
</aside>