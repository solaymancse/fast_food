<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>

    <?php
    session_start();



    ?>


</head>

<body class="bg-gray-100 font-sans antialiased h-screen flex">
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    <!-- Sidebar -->
    <?php include('./customer_sidebar.php'); ?>
    <main class="w-full h-full bg-white">
        <div class="overflow-x-auto">
            <?php
            if (isset($_SESSION['message'])) {
                $message_type = $_SESSION['msg_type'] === "success" ? "bg-green-500" : "bg-red-500";
                echo '<div class="alert ' . $message_type . ' text-white font-bold rounded-lg px-4 py-2 mb-4" role="alert">
                        ' . $_SESSION['message'] . '
                        <button onclick="this.parentElement.style.display=\'none\'" class="float-right ml-2 text-white" aria-label="Close">&times;</button>
                    </div>';
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
            }
            ?>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Location</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6"><?php echo $row['id']; ?></td>
                            <td class="py-3 px-6"><?php echo $row['name']; ?></td>
                            <td class="py-3 px-6"><?php echo $row['phone']; ?></td>
                            <td class="py-3 px-6"><?php echo $row['location']; ?></td>
                            <td class="py-3 px-6">
                                <span class="bg-<?php echo $row['status'] === '1' ? 'green' : 'red'; ?>-200 text-<?php echo $row['status'] === '1' ? 'green' : 'red'; ?>-600 py-1 px-2 rounded">
                                    <?php echo $row['status'] === '1' ? 'Active' : 'Blocked'; ?>
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                <a href="edit_restaurant.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 mr-1">Edit</a>
                                <button onclick="openModal(<?php echo $row['id']; ?>)" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 mr-1">Delete</button>
                                <button onclick="toggleStatus(<?php echo $row['id']; ?>, <?php echo $row['status']; ?>)" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600">
                                    <?php echo $row['status'] === '1' ? 'Block' : 'Unblock'; ?>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>


    <!-- JavaScript to toggle edit mode -->
    <script>
        function toggleEdit() {
            const inputs = document.querySelectorAll('#profileForm input');
            const saveButton = document.getElementById('saveButton');
            inputs.forEach(input => input.toggleAttribute('readonly'));
            saveButton.classList.toggle('hidden');
        }
    </script>

    <script src="./script.js"></script>
</body>

</html>