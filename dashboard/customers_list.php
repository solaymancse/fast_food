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
    include('../config/db.php');

    // Handle restaurant deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $delete_sql = "DELETE FROM restaurant WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Restaurant deleted successfully.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to delete restaurant.";
            $_SESSION['msg_type'] = "error";
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Handle restaurant status update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
        $id = $_POST['id'];
        $current_status = $_POST['status'];
        $new_status = $current_status == 1 ? 0 : 1;
        
        $sql = "UPDATE restaurant SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_status, $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Status updated successfully.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to update status.";
            $_SESSION['msg_type'] = "error";
        }

        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Fetch all restaurants
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn, $sql);
    ?>
</head>

<body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    <?php include('sidebar.php'); ?>
    <div class="main-content">
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
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed z-10 top-0 bg-black bg-opacity-30 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                <h2 class="text-lg font-semibold">Are you sure you want to delete this restaurant?</h2>
                <div class="flex justify-end mt-4">
                    <button onclick="closeModal()" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 mr-2">Cancel</button>
                    <form id="deleteForm" method="POST">
                        <input type="hidden" name="delete_id" id="deleteId">
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">OK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function toggleStatus(id, currentStatus) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.reload();
                }
            };
            xhr.send('id=' + id + '&status=' + currentStatus);
        }
    </script>
</body>

</html>
