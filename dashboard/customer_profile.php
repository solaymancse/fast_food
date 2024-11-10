<?php
session_start();
include('../config/db.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details from the database
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT name, location, phone FROM customers WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $customer_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $location, $phone);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Update profile details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updated_name = mysqli_real_escape_string($conn, $_POST['name']);
    $updated_location = mysqli_real_escape_string($conn, $_POST['location']);
    $updated_phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Update query
    $update_sql = "UPDATE customers SET name = ?, location = ?, phone = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "sssi", $updated_name, $updated_location, $updated_phone, $customer_id);

    if (mysqli_stmt_execute($update_stmt)) {
        // If update is successful, refresh the page with new values
        header("Location: customer_profile.php");
        exit();
    } else {
        $error = "There was an error updating your profile.";
    }

    mysqli_stmt_close($update_stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profile</title>
</head>

<body class="bg-gray-100 font-sans antialiased h-screen flex">
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    
    <!-- Sidebar -->
    <?php include('./customer_sidebar.php'); ?>
    
    <div class="w-full p-6">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <div class="flex flex-col items-center">
                <!-- Profile Image -->
                <div class="w-24 mb-4 h-24 border border-gray-300 rounded-full ring-1 ring-gray-300 items-center overflow-hidden">
                    <img class="w-full h-full" src="../assets/avatar.jpg" alt="">
                </div>
                <!-- Edit Button -->
                <button id="editButton" class="mb-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="toggleEdit()">Edit Profile</button>
            </div>

            <!-- Profile Info -->
            <form id="profileForm" method="POST" action="">
                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" class="w-full p-2 border rounded focus:outline-none" readonly>
                </div>
                <!-- Address -->
                <div class="mb-4">
                    <label class="block text-gray-700">Address</label>
                    <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($location ?? ''); ?>" class="w-full p-2 border rounded focus:outline-none" readonly>
                </div>
                <!-- Phone Number -->
                <div class="mb-4">
                    <label class="block text-gray-700">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" class="w-full p-2 border rounded focus:outline-none" readonly>
                </div>

                <!-- Save Changes Button -->
                <div class="flex justify-center">
                    <button id="saveButton" type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 hidden">Save Changes</button>
                </div>
            </form>

            <?php if (isset($error)): ?>
                <p class="text-red-500 text-center mt-4"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript to toggle edit mode -->
    <script>
        function toggleEdit() {
            const inputs = document.querySelectorAll('#profileForm input');
            const saveButton = document.getElementById('saveButton');
            inputs.forEach(input => input.toggleAttribute('readonly'));
            saveButton.classList.toggle('hidden');
        }
    </script>
</body>

</html>
