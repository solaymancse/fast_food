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
<div class="sidebar">
    <div class="sidebar-container">
        <div class="brand mb-4">
            <h4>
                <span class="lab la-staylinked"></span>
                Fast Food
            </h4>
        </div>

        <div class="flex flex-col justify-between h-[90%] ">
            <div class="sidebar-menu">
                <ul>
                    <li><a href="./dashboard.php" class="active"><span class="las la-adjust"></span><span>Dashboard</span></a></li>
                    <li><a href="./restaurant.php"><span class="las la-video"></span><span>Add Restaurant</span></a></li>
                    <li><a href="./restaurant_list.php"><span class="las la-video"></span><span>Restaurant List</span></a></li>
                    <li><a href="./customers_list.php"><span class="las la-chart-bar"></span><span>Customers List</span></a></li>

                </ul>
            </div>
            <form action="" method="POST" class="p-6 ">
                <button type="submit" name="logout" class="block text-center py-2 px-4 rounded-md bg-red-600 hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>

    </div>
</div>